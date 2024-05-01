<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Models\General\Level;
use App\Models\General\Module;
use App\Models\General\Role;
use App\Notifications\AdminResetPasswordNotification;
use App\Traits\HasNetworkActivity;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, Uri, View, Filterable, DomainScopeTrait;

    protected $guard = 'admin';

    protected $route_name = 'admins';

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    /**
     * level which admin belongs to
     * @return belongsTo
     */
    public function level()
    {
        return $this->belongsTo('App\Models\General\Level')->withoutGlobalScopes();
    }

    /**
     * levels created by admin
     * @return hasMany
     */
    public function levels()
    {
        return $this->hasMany('App\Models\General\Level');
    }

    public function createLevel(Level $level)
    {
        $this->levels()->save($level);
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }

    /**
     * get the admin childs with complete info
     * @return hasMany
     */
    public function childs()
    {
        return $this->hasMany('App\Models\General\Admin', 'admin_id')
            ->where('id', '!=', $this->id)->withoutGlobalScopes();
    }

    /**
     * get the admin childs with limit info (this relation is for specific usages)
     * @return hasMany
     */
    public function child_admins()
    {
        return $this->hasMany('App\Models\General\Admin', 'admin_id')
            ->select('id', 'admin_id')
            ->where('id', '!=', $this->id);
    }

    /**
     *  get the admin childs id up to 10 step + the admin id
     * @return array array of admins id
     */
    public function childAdminsId()
    {
        $nested_admins = $this->load([
            'child_admins.child_admins.child_admins.child_admins.child_admins.child_admins.child_admins.child_admins.child_admins.child_admins',
        ])->toArray();

        return array_values(array_sort(array_unique(
            array_flatten($nested_admins['child_admins']) + [$this->id]
        )));
    }

    /**
     * get levels which is created by the admin or is childs
     * except the level which associated with the admin
     * @return App\Models\General\Level
     */
    public function getOwnedLevels()
    {
        return Level::whereIn('admin_id', $this->childAdminsId())
            ->where('id', '!=', $this->level_id)
            ->latest();
    }

    /**
     * return levels id as an string which is owned by the admin
     * @return string
     */
    public function getOwnedLevelsId()
    {
        return $this->getOwnedLevels()->pluck('id')->implode(',', 'id');
    }

    public function getOwnedRoles()
    {
        return Role::where('id', '>', $this->role_id);
    }

    /**
     * return roles id as an string which is owned by the admin
     * @return string
     */
    public function getOwnedRolesId()
    {
        return $this->getOwnedRoles()->pluck('id')->implode(',', 'id');
    }

    /**
     * return module which admin has permission to, with controllers and actions eager loaded
     * @param App\Models\General\Module
     */
    public function modules()
    {
        $controllers_id = $this->level->actions->where('visible', true)->pluck('controller_id')
            ->unique()->toArray();
        $actions_id = $this->level->actions->where('visible', true)->pluck('id')
            ->toArray();

        $modules = Module::with([
            'controllers' => function ($query) use ($controllers_id) {
                $query->whereIn('id', $controllers_id);
            },
            'controllers.actions' => function ($query) use ($actions_id) {
                $query->whereIn('id', $actions_id);
            },
        ])
            ->get();

        // filter modules and remove if it has no controller
        $modules = $modules->filter(function ($module) {
            if (count($module->controllers)) {
                return $module;
            }
            return false;
        });

        return $modules;
    }

    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->family;
    }

    public function getSuccessLoginMessageAttribute()
    {
        return 'کاربر گرامی : ' . $this->fullname . ' ورود شما با موفقیت انجام شد.';
    }

    /**
     * upload file
     *
     * @param Illuminate\Http\UploadedFile $file request file
     * @param string $store_path
     * @param boolean $hashed_filename
     * if set to True a random hashed file name will be generate (the file path will like /$store_path/haeshed_file_name)
     * if Not the file name will be the admin id (the file path will like /$store_path/admin_id.file_extension)
     * @return array return file_path in an array
     */
    public function uploadFile(UploadedFile $file, $store_path = null, $hashed_filename = false, $disk = 'public')
    {
        if (!$store_path) {
            $store_path = $this->id;
        }
        if ($hashed_filename) {
            $file_path = $file->store($store_path, ['disk' => $disk]);
        } else {
            $filename = $file->getClientOriginalName();
            $file_path = $file->storeAs($store_path, $filename, ['disk' => $disk]);
        }
        $file_path = ($disk == 'public') ? '/storage/' . $file_path : '/files/' . $file_path;
        return [['path' => $file_path]];
    }

    /**
     * get admin authenticated user owned roles options for mutltiselect input
     * @return Illuminate\Support\Collection
     */
    public function getOwnedLevelOptions()
    {
        return $this->getOwnedLevels()->select('id', 'title as name')->get();
    }

    /**
     * get admin authenticated user owned roles options for mutltiselect input
     * @return Illuminate\Support\Collection
     */
    public function getOwnedRoleOptions()
    {
        return $this->getOwnedRoles()->select('id', 'title as name')->get();
    }

    public function createAdmin($data)
    {
        $data = multiselect_adapter($data);
        $data['password'] = bcrypt($data['password']);
        $new_admin = new static($data);
        $this->childs()->save($new_admin);
    }

    /**
     * update admin
     * @param array $data
     * @return bool
     */
    public function updateAdmin($data)
    {
        $data = multiselect_adapter($data);
        if (!empty(array_get($data, 'password', ''))) {
            $data['password'] = bcrypt($data['password']);
        }
        $this->update($data);
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function createUser($data)
    {

        $data = multiselect_adapter($data);

        if (!empty(array_get($data, 'password', ''))) {
            $data['password'] = bcrypt($data['password']);
        }
        $user = new User($data);


        $this->users()->save($user);
    }

    public static function scopeAsOption($query)
    {
        return $query->select('id', \DB::raw("CONCAT(name, ' ', family) as name"))->where('id', '!=', '1')->get();
    }

    public static function scopeAsOptionExceptMe($query)
    {
        return $query
            ->select('id', \DB::raw("CONCAT(name, ' ', family) as name"))
            ->where('id', '!=', '1')
            ->where('id', '!=', auth()->id())
            ->get();
    }

    public function task()
    {
        return $this->hasMany('App\Models\General\Task', 'creator_admin_id');
    }

    public function refers()
    {
        return $this->hasMany('App\Models\General\Refer', 'from_admin_id');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\General\Customer');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\General\Ticket', 'creator_id');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\General\Attendance');
    }

    public function sended_letters()
    {
        return $this->hasMany('App\Models\General\SendedLetter');
    }

    public function selected_customers()
    {
        return $this->hasMany('App\Models\General\SelectedCustomer', 'admin_id');
    }

    /**
     * Define a one-to-one relationship to AdminProfile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(AdminProfile::class);
    }
}
