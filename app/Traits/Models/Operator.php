<?php

namespace App\Traits\Models;

trait Operator
{
    public function scopeBlacklist($query)
    {
        return $query->where('deliver_state', 5);
    }

    public function scopeSendedBlacklist($query)
    {
        return $query->blacklist()->where('blacklist_status', 1);
    }

    public function scopeNotSendedBlacklist($query)
    {
        return $query->blacklist()->where('blacklist_status', 0);
    }

    public function getIsDeliverStatusCompleteAttribute()
    {
        return (bool) !$this->unspecifiedDeliverStatusCount;
    }

    public function getUnspecifiedDeliverStatusCountAttribute()
    {
        return $this->where('deliver_state', 0)->count();
    }

    public function getAdminBlacklistPriceAttribute()
    {
        return $this->long * config('portal.blacklist_price_for_admin');
    }

    public function getUserBlacklistPriceAttribute()
    {
        return $this->long * config('portal.blacklist_price_for_user');
    }

    public function blacklistSended()
    {
        return $this->update(['blacklist_status' => 1]);
    }

    public function scopeNumberPrefixedBy($query, $prefixes = [])
    {
        return $query->where(function ($query) use ($prefixes) {
            for ($i = 0; $i < count($prefixes); $i++) {
                $query->orWhere('number', 'like', $prefixes[$i] . '%');
            };
        });
    }

    /**
     * filter numbers with specific prefixes
     * @param  boolean $limit_by_prefixes
     * @param  array   $allowed_mobile_prefixes_group
     */
    public function scopeLimitByNumberPrefixes($query, $limit_by_prefixes = false, $allowed_mobile_prefixes_group = [])
    {
        if (!$limit_by_prefixes) {
            return $query;
        }
        $prefixes = get_mobile_prefixes($allowed_mobile_prefixes_group);
        return $query->numberPrefixedBy($prefixes);
    }

}
