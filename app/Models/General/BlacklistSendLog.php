<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class BlacklistSendLog extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'blacklist_send_logs';

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function scopeToday($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfDay(),
            now()->endOfDay(),
        ]);
    }

    public function scopeReffer($query)
    {
        return $query->whereNotIn('send_type', ['خروجی', 'voice']);
    }

    public function scopeExport($query)
    {
        return $query->where('send_type', 'خروجی');
    }

    /**
     * @return integer
     */
    public static function todayTotalNoteParts()
    {
        return static::today()->sum('total_note_parts');
    }

    /**
     * @return integer
     */
    public static function todayRefferNoteParts()
    {
        return static::today()->reffer()->sum('total_note_parts');
    }

    /**
     * @return integer
     */
    public static function todayExportNoteParts()
    {
        return static::today()->export()->sum('total_note_parts');
    }

    /**
     * @return integer
     */
    public static function todayReceiversCount()
    {
        return static::today()->sum('receivers_count');
    }

    /**
     * @return integer
     */
    public static function todayRefferReceiversCount()
    {
        return static::today()->reffer()->sum('receivers_count');
    }

    /**
     * @return integer
     */
    public static function todayExportReceiversCount()
    {
        return static::today()->export()->sum('receivers_count');
    }

    public function getExportFileUriAttribute()
    {
        return '/blacklists/blacklists/export_sends_partial' . ltrim($this->export_file, 'exports');
    }

    // {{dont_delete_this_comment}}
}
