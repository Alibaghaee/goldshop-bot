<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\HasComment;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

class Comment extends Model
{
    use Uri, View, Filterable, HasComment;

    protected $route_name = 'comments';

    protected $guarded = [];


    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'درانتظار'],
        ['id' => 'published', 'name' => 'منتشر شده'],
    ];

    /**
     * Define a polymorphic, inverse one-to-many relationship To Commentable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    public function getStatusFaAttribute()
    {

        return collect(self::$STATUS_LIST)
            ->where('id', $this->getAttribute('status'))
            ->first()['name'];
    }


    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('H:i /  Y-m-d ');
    }

    public function getUpdatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->updated_at)->format('Y/m/d H:i');
    }

    public function getRelatedTitleAttribute()
    {

        if (get_class($this->commentable) === Content::class) {

            return 'محتوا' . ' : ' . $this->commentable->title;
        } elseif (get_class($this->commentable) === \App\Models\General\Comment::class) {

            $string = 'ریپلای به :';

            if ($this->commentable->user_id) {

                return $string . optional($this->commentable->user)->fullname;
            } elseif ($this->commentable->admin_id) {

                return $string . optional($this->commentable->admin)->fullname;
            } elseif ($this->commentable->guest_name) {

                return $string . $this->commentable->guest_name;
            }


            return '';
        }


        return $this->commentable_type;

    }

    public function getShortRelatedTitleAttribute()
    {
        if (get_class($this->commentable) === Content::class) {

            return Str::limit('محتوا' . ' : ' . $this->commentable->title, 30, " ...");
        } elseif (get_class($this->commentable) === \App\Models\General\Comment::class) {
            $string = 'ریپلای به :';

            if ($this->commentable->user_id) {

                return $string . Str::limit(optional($this->commentable->user)->fullname, 30, " ...");
            } elseif ($this->commentable->admin_id) {

                return $string . Str::limit(optional($this->commentable->admin)->fullname, 30, " ...");
            } elseif ($this->commentable->guest_name) {

                return $string . Str::limit($this->commentable->guest_name, 30, " ...");
            }
            return '';
        }

        return $this->commentable_type;
    }

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


    // {{dont_delete_this_comment}}
}
