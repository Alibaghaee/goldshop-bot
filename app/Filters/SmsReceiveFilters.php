<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Models\General\TabiatProduct;
use Illuminate\Database\Eloquent\Builder;

class SmsReceiveFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by id.
     *
     * @param  string $id
     * @return Builder
     */
    public function id($id)
    {
        return $this->builder->where('_id', $id);
    }

    /**
     * Filter by note.
     *
     * @param  string $note
     * @return Builder
     */
    public function note($note)
    {
        return $this->builder->where('note', $note);
    }

    /**
     * Filter by sender.
     *
     * @param  string $sender
     * @return Builder
     */
    public function sender($sender)
    {
        return $this->builder->where('sender', $sender);
    }

    /**
     * Filter by receiver.
     *
     * @param  string $receiver
     * @return Builder
     */
    public function receiver($receiver)
    {
        return $this->builder->where('receiver', $receiver);
    }

    /**
     * Filter by sms_id.
     *
     * @param  string $sms_id
     * @return Builder
     */
    public function sms_id($sms_id)
    {
        return $this->builder->where('sms_id', $sms_id);
    }

    /**
     * Filter by status.
     *
     * @param  string $status
     * @return Builder
     */
    public function status($status)
    {
        $status = json_decode($status);
        return $this->builder->where('status', $status->id);
    }

    /**
     * Filter by code_state.
     *
     * @param  string $code_state
     * @return Builder
     */
    public function code_state($code_state)
    {
        $code_state = json_decode($code_state);
        return $this->builder->where('code_state', $code_state->id);
    }

    /**
     * Filter by ignored.
     *
     * @param  string $ignored
     * @return Builder
     */
    public function ignored($ignored)
    {
        $ignored = ($ignored == 'true') ? true : false;
        return $this->builder->where('ignored', $ignored);
    }

    /**
     * Filter by product.
     *
     * @param  string $product
     * @return Builder
     */
    public function product($product)
    {
        $product = json_decode($product);
        return $this->builder->where('tabiat_product_id', $product->id);
    }

    /**
     * Filter by product_catgory.
     *
     * @param  string $product_catgory
     * @return Builder
     */
    public function product_catgory($product_catgory)
    {
        $product_catgory = json_decode($product_catgory);
        $ids             = TabiatProduct::where('tabiat_product_category_id', $product_catgory->id)->pluck('id');

        return $this->builder->whereIn('tabiat_product_id', $ids);
    }

    /**
     * Filter by created_at min.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_min($created_at)
    {
        return $this->builder->where('created_at', '>=', new \DateTime($created_at));
    }

    /**
     * Filter by created_at max.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_max($created_at)
    {
        return $this->builder->where('created_at', '<=', new \DateTime($created_at));
    }

}
