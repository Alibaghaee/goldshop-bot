<?php

namespace App;

use App\Filters\Filterable;
use App\Models\General\AdminProfile;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class NetworkActivity extends Model
{
    use Filterable;

    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'network_activitiable_type',
        'network_activitiable_id',
        'admin_profile_id'
    ];


    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s');
    }

    /**
     * Define a polymorphic, inverse one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function networkActivitiable()
    {
        return $this->morphTo();
    }


    /**
     * Define an inverse one-to-many relationship to AdminProfile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminProfile()
    {
        return $this->belongsTo(AdminProfile::class);
    }
}
