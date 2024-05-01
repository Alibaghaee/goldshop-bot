<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'news_letters';

    protected $guarded = [];

    public static $PENDING = 'pending';
    public static $SENDING = 'sending';
    public static $SENT = 'sent';


    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'درانتظار'],
        ['id' => 'sending', 'name' => 'درحال ارسال'],
        ['id' => 'sent', 'name' => 'ارسال شده'],
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

            if ($model->users()->exists()) {

                optional($model->users())->sync(null);
            }
            if ($model->drivers()->exists()) {

                optional($model->drivers())->sync(null);
            }
        });
    }


    /**
     * Define a polymorphic, inverse many-to-many relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */

    public function users()
    {
        return $this->morphedByMany(User::class, 'news_letterable');
    }


    public function getStatusFaAttribute()
    {

        return collect(self::$STATUS_LIST)
            ->where('id', $this->getAttribute('status'))
            ->first()['name'];
    }

    /**
     * Define a polymorphic, inverse many-to-many relationship to Driver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */

    public function drivers()
    {
        return $this->morphedByMany(Driver::class, 'news_letterable');
    }

    public function scopePending($query)
    {
        return $query->where('status', self::$PENDING);
    }


    /**
     *Update status
     *
     * @return void
     **/
    public function sent()
    {
        $this->update([
            'status' => self::$SENT
        ]);
    }

    /**
     *Update status
     *
     * @return void
     **/
    public function sending()
    {
        $this->update([
            'status' => self::$SENDING
        ]);
    }

    // {{dont_delete_this_comment}}
}
