<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\HasPublishedScope;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class PanelSms extends Model
{
    use Uri, View, Filterable, HasPublishedScope;

    protected $route_name = 'panel_sms';

    protected $guarded = [];


    protected $fillable = [
        'password',
        'username',
        'domain',
        'status',
        'type',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'username',
        'domain',
        'status',
        'type',
    ];


    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'غیرفعال'],
        ['id' => 'published', 'name' => 'فعال'],
    ];

    public static $TYPE_LIST = [
        ['id' => 'owner', 'name' => 'پنل شخصی'],
        ['id' => 'company', 'name' => 'پنل شرکت'],
    ];

    public static $DOMAIN_LIST = [
        ['id' => '5m5.ir', 'name' => '5m5'],
        ['id' => 'sms20.ir', 'name' => 'sms20'],
    ];




    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (!is_null($model->password)) {


                $model->setAttribute('password', Crypt::encryptString($model->password));
            }
        });

        static::updating(function ($model) {

            if (!is_null($model->password)) {


                $model->password = Crypt::encryptString($model->password);
            }
        });

        static::deleting(function ($model) {
            $model->senderNumbers()->each(function ($item) {
                $item->delete();
            });

            $model->contactCategories()->each(function ($item) {
                $item->delete();
            });
        });
    }


    public static function getStatusArray($id)
    {
        if (collect(self::$STATUS_LIST)
                ->where('id', $id)->count() > 0) {

            return collect(self::$STATUS_LIST)
                ->where('id', $id)
                ->first();
        }
        return [];
    }

    public static function getDomainArray($id)
    {
        if (collect(self::$DOMAIN_LIST)
                ->where('id', $id)->count() > 0) {

            return collect(self::$DOMAIN_LIST)
                ->where('id', $id)
                ->first();
        }
        return [];
    }


    public function transList($id, $list)
    {
        if (collect($list)
                ->where('id', $id)->count() > 0) {

            return collect($list)
                ->where('id', $id)
                ->first()['name'];
        }
        return 'undefined';
    }


    public function getStatusFaAttribute()
    {
        return $this->transList($this->status, self::$STATUS_LIST);
    }

    public function getDomainAliasAttribute()
    {
        return $this->transList($this->domain, self::$DOMAIN_LIST);
    }

    public function getTypeFaAttribute()
    {
        return $this->transList($this->type, self::$TYPE_LIST);
    }


    public function getDecryptPasswordAttribute()
    {
        return Crypt::decryptString($this->password);
    }

    public function getSenderNumbersCountAttribute()
    {
        return $this->senderNumbers->count();
    }


    /**
     * Define a one-to-many relationship SenderNumber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function senderNumbers()
    {
        return $this->hasMany(SenderNumber::class);
    }

    /**
     * Define a one-to-many relationship ContactCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactCategories()
    {
        return $this->hasMany(ContactCategory::class);
    }

    public function scopeAsOption(Builder $query)
    {
        return $query->select(\DB::raw("username as name"), 'id');
    }

    public function scopeOwner(Builder $query)
    {
        return $query->where('type', 'owner');
    }


    // {{dont_delete_this_comment}}
}
