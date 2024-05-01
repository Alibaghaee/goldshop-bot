<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class PaymentFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by title.
     *
     * @param  string $title
     * @return Builder
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', '%' . $title . '%');
    }

    /**
     * Filter by price.
     *
     * @param  string $price
     * @return Builder
     */
    public function price($price)
    {
        return $this->builder->where('price', $price);
    }

    /**
     * Filter by user.
     *
     * @param  string $user
     * @return Builder
     */
    public function user($user)
    {
        $user = json_decode($user);
        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter by tracking_code.
     *
     * @param  string $tracking_code
     * @return Builder
     */
    public function tracking_code($tracking_code)
    {
        return $this->builder->where('tracking_code', $tracking_code);
    }

    /**
     * Filter by payed.
     *
     * @param  string $payed
     * @return Builder
     */
    public function payed($payed)
    {
        $payed = ($payed == 'true') ? true : false;
        return $this->builder->where('payed', $payed);
    }

    /**
     * Filter by created_at min.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_min($created_at)
    {
        return $this->builder->whereDate('created_at', '>=', $created_at);
    }

    /**
     * Filter by created_at max.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_max($created_at)
    {
        return $this->builder->whereDate('created_at', '<=', $created_at);
    }

    /**
     * Filter by card_number.
     *
     * @param  string $card_number
     * @return Builder
     */
    public function card_number($card_number)
    {
        return $this->builder->where('card_number', 'like', '%' . $card_number . '%');
    }

    /**
     * Filter by transaction_id.
     *
     * @param  string $transaction_id
     * @return Builder
     */
    public function transaction_id($transaction_id)
    {
        return $this->builder->where('transaction_id', 'like', '%' . $transaction_id . '%');
    }

    /**
     * Filter by description.
     *
     * @param  string $description
     * @return Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', '%' . $description . '%');
    }

}
