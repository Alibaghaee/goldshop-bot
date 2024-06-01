<?php

namespace App\Models;

use App\Models\General\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class OrderBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'item',
        'price',
        'count',
        'weight',
        'status',
        'user_id',
        'admin_id'
    ];


    /**
     * Define an inverse one-to-many relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define an inverse one-to-many relationship to Admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }
}
