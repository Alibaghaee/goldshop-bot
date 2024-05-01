<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Models\General\Module;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $fillable = ['title'];

    protected $route_name = 'levels';

    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\General\Role');
    }

    public function actions()
    {
        return $this->belongsToMany('App\Models\General\Action')->withTimestamps();
    }

    public function getFacilitiesUriAttribute()
    {
        return '/facilities/facilities/' . $this->id . '/edit';
    }

    public static function createLevel($data)
    {
        static::forceCreate([
            'title' => $data['title'],
        ]);
    }

    public function validateSelectedActionsId($selected_actions)
    {
        return $this->admin->level->actions
            ->whereIn('id', $selected_actions)
            ->pluck('id')
            ->toArray();
    }

    /**
     * return module which admin has permission to, with controllers and actions eager loaded
     * @param App\Models\General\Module
     */
    public function Modules()
    {
        $controllers_id = $this->actions->pluck('controller_id')->unique()->toArray();
        $actions_id     = $this->actions->pluck('id')->toArray();

        $modules = Module::select(['id', 'title'])
            ->with([
                'controllers'         => function ($query) use ($controllers_id) {
                    $query->select('id', 'title', 'module_id')
                        ->whereIn('id', $controllers_id);
                },
                'controllers.actions' => function ($query) use ($actions_id) {
                    $query->select('id as value', 'title as text', 'controller_id')
                        ->whereIn('id', $actions_id);
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

}
