<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\HasComment;
use App\Traits\Models\HasLike;
use App\Traits\Models\Locale;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Content extends Model
{
    use Uri, View, Filterable, DomainScopeTrait, Locale, HasComment, HasLike;

    protected $route_name = 'contents';

    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'publish_date',
        'expire_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->locale_id = 1;
        });

        static::creating(function ($model) {
            $model->locale_id = 1;
        });
    }

    public function category_item()
    {
        return $this->belongsTo('App\Models\General\CategoryItem', 'category_item_id');
    }


    public static function createContent($data)
    {
        $data = multiselect_adapter($data);

        static::create($data);
    }

    public function updateContent($data)
    {
        $data = multiselect_adapter($data);

        $this->update($data);
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', true);
    }

    public function scopePublishTime($query)
    {
        return $query->where(function ($query) {

            $query->whereNull('publish_date')
                ->orWhere('publish_date', '<=', now());

        })->where(function ($query) {

            $query->whereNull('expire_date')
                ->orWhere('expire_date', '>=', now());

        });
    }

    public function scopeWhereSlug($query, $slug)
    {
        return $query->where('address_slug', $slug);
    }

    public function scopeLocale($query)
    {
        return $query->where('locale_id', session('locale_id'));
    }

    public static function getBySlug($slug)
    {
        return static::locale()->whereSlug($slug)->isActive()->firstOrFail();
    }

    public function getUrlAttribute()
    {


        if (optional($this->category_item)->category_id === 22) {

            return '/' . $this->locale_name . '/content/' . $this->id;
        }

        return '/' . $this->locale_name . '/content/menu/' . $this->id;
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('H:i / d - m - Y');
    }

    public function getTelegramShareAttribute()
    {
        return 'https://t.me/share/url?url=' . request()->getHttpHost() . $this->url;
    }

    public function getTwitterShareAttribute()
    {
        return 'https://twitter.com/intent/tweet?text='
            . request()->getHttpHost() . $this->url;
    }

    public function getFacebookShareAttribute()
    {
        return 'https://www.facebook.com/sharer/sharer.php?u='
            . request()->getHttpHost() . $this->url;
    }

    public function getGmailShareAttribute()
    {
        return "mailto:?subject=$this->title&body="
            . request()->getHttpHost() . $this->url;
    }

    public function getSmsShareAttribute()
    {
        return "sms:?&body="
            . request()->getHttpHost() . $this->url;
    }

    public function getIsBimeAttribute()
    {

        return optional($this->category_item)->category_id === 24;
    }

    public static function mostVisited($take, $category_item = false)
    {
        return self::isActive()
            ->when($category_item, function (Builder $q) {
                $q->whereNotNull('category_item_id')
                    ->where('category_item_id', '!=', '0');
            })->whereHas('category_item', function ($q) {
                $q->where('category_id', 22);
            })->orderBy('views')->take($take)->get();
    }

    // {{dont_delete_this_comment}}
}
