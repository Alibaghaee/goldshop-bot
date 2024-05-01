<?php

namespace App\Helpers;

use App\Models\General\DiscountItem;
use Carbon\Carbon;

class DiscountCode
{
    /**
     * Prefix for code generation
     *
     * @var string
     */
    protected $prefix;

    /**
     * Suffix for code generation
     *
     * @var string
     */
    protected $suffix;

    /**
     * Number of codes to be generated
     *
     * @var int
     */
    protected $count = 1;

    /**
     * discount_amount value which will be sticked to code
     *
     * @var null
     */
    protected $discount_amount = null;

    /**
     * Additional data to be returned with code
     *
     * @var array
     */
    protected $data = [];

    /**
     * Number of days of code expiration
     *
     * @var null|int
     */
    protected $expires_at = null;

    /**
     * Maximum number of available usage of code
     *
     * @var null|int
     */
    protected $max_uses = null;

    /**
     * Generated codes will be saved here
     * to be validated later.
     *
     * @var array
     */
    private $codes = [];

    /**
     * Length of code will be calculated from asterisks you have
     * set as mask in your config file.
     *
     * @var int
     */
    private $length;

    /**
     * DiscountItems constructor.
     */
    public function __construct()
    {
        $this->codes  = DiscountItem::pluck('code')->toArray();
        $this->length = substr_count(config('discount.mask'), '*');

        $this->prefix = (bool) config('discount.prefix')
        ? config('discount.prefix') . config('discount.separator')
        : '';

        $this->suffix = (bool) config('discount.suffix')
        ? config('discount.separator') . config('discount.suffix')
        : '';
    }

    /**
     * Save discount_items into database
     * Successful insert returns generated discount_items
     * Fail will return empty collection.
     *
     * @param int $count
     * @param null $discount_amount
     * @param date|null $starts_at
     * @param date|null $expires_at
     * @param bool $is_percent
     * @param int $max_uses
     *
     * @return \Illuminate\Support\Collection
     */
    public function create(
        $discount_id = null,
        $count = null,
        $discount_amount = null,
        $starts_at = null,
        $expires_at = null,
        $is_percent = false,
        $max_uses = 1
    ) {
        $records = [];

        foreach ($this->output($count) as $code) {
            $records[] = [
                'discount_id'     => $discount_id,
                'code'            => $code,
                'discount_amount' => $discount_amount,
                'expires_at'      => $expires_at,
                'starts_at'       => $starts_at,
                'is_percent'      => $is_percent,
                'max_uses'        => $max_uses,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ];
        }

        return collect($records);
    }

    /**
     * Generates discount_items as many as you wish.
     *
     * @param int $count
     *
     * @return array
     */
    public function output($count = null)
    {
        $collection = [];

        for ($i = 1; $i <= $count; $i++) {
            $random = $this->generate();

            while (!$this->validate($collection, $random)) {
                $random = $this->generate();
            }

            array_push($collection, $random);
        }

        return $collection;
    }

    /**
     * Here will be generated single code using your parameters from config.
     *
     * @return string
     */
    private function generate()
    {
        $characters    = config('discount.characters');
        $mask          = config('discount.mask');
        $discount_item = '';
        $random        = [];

        for ($i = 1; $i <= $this->length; $i++) {
            $character = $characters[rand(0, strlen($characters) - 1)];
            $random[]  = $character;
        }

        shuffle($random);
        $length = count($random);

        $discount_item .= $this->prefix;

        for ($i = 0; $i < $length; $i++) {
            $mask = preg_replace('/\*/', $random[$i], $mask, 1);
        }

        $discount_item .= $mask;
        $discount_item .= $this->suffix;

        return $discount_item;
    }

    /**
     * Your code will be validated to be unique for one request.
     *
     * @param $collection
     * @param $new
     *
     * @return bool
     */
    private function validate($collection, $new)
    {
        return !in_array($new, array_merge($collection, $this->codes));
    }

    /**
     * Apply discount_item to user that it's used from now.
     *
     * @param string $code
     *
     * @return bool|DiscountItem
     */
    public function apply($code)
    {
        if ($discount_item = $this->check($code)) {
            if (!is_null($discount_item->max_uses)) {
                $discount_item->uses += 1;
                $discount_item->save();
            }

            return true;
        }

        return false;
    }

    /**
     * Check discount_item in database if it is valid.
     *
     * @param string $code
     *
     * @return bool|DiscountItem
     */
    public function check($code)
    {
        $discount_item = DiscountItem::where('code', $code)->first();

        if ($discount_item === null || !$discount_item->IsStarted() || $discount_item->isExpired() || $discount_item->isOverMaxUses()) {
            return false;
        }

        return $discount_item;
    }
}
