<?php

namespace App\Http\Controllers\General;

use App\Filters\SettingFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingCollection;
use App\Models\General\Setting;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SettingFilters $filters)
    {
        if (request()->expectsJson()) {
            return new SettingCollection(Setting::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['locales'] = config('portal.locales_option');
        $data['options']['types']   = config('portal.setting_types');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Setting,
            'types' => config('portal.setting_types'),
        ]);
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateAvatar($request);
            return $request->user()->uploadFile($request->value, 'settings/file', true);
        }

        // validate
        $data = $this->validateStore($request);
        $data = multiselect_adapter($data);

        // create
        Setting::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('settings.index')]);
        }

        return redirect()
            ->route('settings.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified setting.
     *
     * @param  \App\Models\General\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified setting.
     *
     * @param  \App\Models\General\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.globals.edit', [
            'model'     => $setting,
            'edit_form' => true,
            'types'     => config('portal.setting_types'),
        ]);
    }

    /**
     * Update the specified setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\General\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        // validate
        $data = $this->validateUpdate($request);
        $data = multiselect_adapter($data);

        // create
        $setting->update($data);

        success_flash();
        return response(['redirect' => route('settings.index')]);
    }

    /**
     * Remove the specified setting from storage.
     *
     * @param  \App\Models\General\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        return response([
            'result' => $setting->remove(),
        ]);
    }

    private function validateStore(Request $request)
    {
        return $request->validate([
            'title'     => 'required|string|max:255',
            'value'     => 'required|string|max:10000',
            'type'      => 'required',
            'removable' => 'boolean',
        ]);
    }

    private function validateUpdate(Request $request)
    {
        return $request->validate([
            'title'     => 'required|string|max:255',
            'value'     => 'required|string|max:10000',
            'removable' => 'boolean',
        ]);
    }

    public function validateAvatar(Request $request)
    {
        $request->validate(['value' => 'file']);
    }
}
