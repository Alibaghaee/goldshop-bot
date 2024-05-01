<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\HasNetworkActivity;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use Uri, View, Filterable,HasNetworkActivity;

    protected $route_name = 'admin_profiles';

    protected $guarded = [];


    /**
     * Define an inverse one-to-one relationship to Admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    public function getNameAttribute()
    {
        return optional($this->admin)->name;
    }

    public function getUsernameAttribute()
    {
        return optional($this->admin)->username;
    }

    public function getEmailAttribute()
    {
        return optional($this->admin)->email;
    }

    // {{dont_delete_this_comment}}
}
