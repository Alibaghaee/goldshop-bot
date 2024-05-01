<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['order'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function controllers()
    {
        return $this->hasMany('App\Models\General\Controller');
    }

    public static function createModule($module)
    {
        $module_model = static::create($module['module']);
        $module_model->createControllers($module['controllers']);
    }

    public function createControllers($controllers)
    {
        foreach ($controllers as $controller) {
            $controller_model = $this->controllers()->create($controller['controller']);
            $controller_model->createActions($controller['actions']);
        }
    }

    public static function getOptions()
    {
        return static::select('title as name', 'id')->get();
    }

    public static function scopeAsOption($query)
    {
        return $query->select('modules.id', 'title as name')->get();
    }
}
