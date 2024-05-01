<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\HasPublishedScope;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
{
    use Uri, View, Filterable, HasPublishedScope;

    protected $route_name = 'contact_categories';

    protected $guarded = [];

    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'در انتظار'],
        ['id' => 'published', 'name' => 'منتشرشده'],
    ];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->contactNumbers()->each(function ($item) {
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


    public function transStatus($id)
    {
        if (collect(self::$STATUS_LIST)
                ->where('id', $id)->count() > 0) {

            return collect(self::$STATUS_LIST)
                ->where('id', $id)
                ->first()['name'];
        }
        return 'undefined';
    }


    public function getStatusFaAttribute()
    {
        return $this->transStatus($this->status);
    }


    public function getContactListUrlAttribute()
    {
        return route('contact_numbers.index', ['contact_category_id' => $this->id]);
    }

    public function getContactsCountAttribute()
    {
        return $this->contactNumbers->count();
    }


    public static function scopeAsGroupOption($query)
    {

        return $query->select('title as name', 'id');
    }


    /**
     * Define a one-to-many relationship to ContactNumber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactNumbers()
    {
        return $this->hasMany(ContactNumber::class);
    }


    /**
     * Define an inverse one-to-many relationship to PanelSms.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function panelSms()
    {
        return $this->belongsTo(PanelSms::class);
    }


    // {{dont_delete_this_comment}}
}
