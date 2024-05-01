<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ProductItem extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'products.product_items';

    protected $appends = ['video_page_url', 'jozveh_path', 'track_count'];

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\General\Product');
    }

    public function children()
    {
        return $this->hasMany('App\Models\General\MenuItem', 'parent_item_id')
            ->select('parent_item_id', 'title', 'id', 'link')
            ->orderBy('order');
    }

    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file, PATHINFO_EXTENSION);
    }

    public function filePath($type = 'SD')
    {
        return '/files/' . $this->product_id . '/' . $type . '/' . base64_encode((pathinfo($this->file, PATHINFO_BASENAME)));
    }

    public function getJozvehPathAttribute()
    {
        return '/files/' . pathinfo($this->file, PATHINFO_BASENAME);
    }

    public function getVideoPageUrlAttribute()
    {
        return route('dashboard.play', [app()->getLocale(), $this->id]);
    }

    public function getTypeTitleAttribute()
    {
        return Arr::get(collect(config('portal.educational_content_types'))->firstWhere('id', $this->type), 'name');
    }

    public function getRelatedVideosOptionsAttribute()
    {
        $related_videos = $this->product
            ->items()
            ->where('id', '!=', $this->id)
            ->orderByRaw('RAND()')
            ->take(4)
            ->get()
            ->transform(function ($item) {
                return [
                    'thumb'    => $item->cover,
                    'url'      => $item->video_page_url,
                    'title'    => $item->title,
                    'duration' => '',
                ];
            })
            ->toArray();

        return $related_videos;
    }

    public function getVideojsOptionsAttribute()
    {
        $options = [
            'video_id'       => $this->id,
            'rewindforward'  => 10, // second
            'endAction'      => 'related',
            'related'        => $this->related_videos_options,
            'target'         => '_self',
            'relatedMenu'    => true,
            'shareMenu'      => false,
            'buttonRewind'   => true,
            'buttonForward'  => true,
            'theaterButton'  => false,
            'resume'         => true,
            'zoomWheel'      => true,
            'contextMenu'    => false,
            'logo'           => setting(config('portal.setting_id.player_logo')),
            'logocontrolbar' => setting(config('portal.setting_id.player_logo')),
            'logourl'        => '/',
            'logoposition'   => 'RT',
            // 'videoInfo' => true,
            // 'title' => $this->title,
            // 'slideImage' => '//domain.com/path/to/sprite.jpg',
            // 'slideType' => 'vertical',  //optional
            // 'slideWidth' => 160,  //optional
            // 'slideHeight' => 90,  //optional
        ];

        return json_encode($options);
    }

    public function getPrerollOptionsAttribute()
    {
        $options = [
            'src'    => setting(config('portal.setting_id.preroll_ads_video')),
            'type'   => "video/mp4",
            'href'   => setting(config('portal.setting_id.preroll_ads_link')),
            'offset' => 0,
            'skip'   => setting(config('portal.setting_id.preroll_ads_skip_seconds')), //optional skip video option.
            'id'     => 1, //optional preroll video ID if you wish to track ad action.
        ];

        $options = setting(config('portal.setting_id.ads_active')) != 0 ? $options : [];

        return json_encode($options);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'video_user', 'video_id', 'user_id')
            ->withTimestamps()
            ->withPivot('duration', 'current_time', 'state', 'remaining_time_display');
    }

    public function getTrackCountAttribute()
    {
        return $this->users()->count();
    }

}
