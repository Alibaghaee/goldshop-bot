<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class PayFilters extends QueryFilters
{
    use GlobalFilters;

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

    /**
     * Filter by name.
     *
     * @param  string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Filter by family.
     *
     * @param  string $family
     * @return Builder
     */
    public function family($family)
    {
        return $this->builder->where('family', 'like', '%' . $family . '%');
    }

    /**
     * Filter by mobile.
     *
     * @param  string $mobile
     * @return Builder
     */
    public function mobile($mobile)
    {
        return $this->builder->where('mobile', 'like', '%' . $mobile . '%');
    }

    /**
     * Filter by phone.
     *
     * @param  string $phone
     * @return Builder
     */
    public function phone($phone)
    {
        return $this->builder->where('phone', 'like', '%' . $phone . '%');
    }

    /**
     * Filter by emergency_mobile.
     *
     * @param  string $emergency_mobile
     * @return Builder
     */
    public function emergency_mobile($emergency_mobile)
    {
        return $this->builder->where('emergency_mobile', 'like', '%' . $emergency_mobile . '%');
    }

    /**
     * Filter by national_code.
     *
     * @param  string $national_code
     * @return Builder
     */
    public function national_code($national_code)
    {
        return $this->builder->where('national_code', 'like', '%' . $national_code . '%');
    }

    /**
     * Filter by gender.
     *
     * @param  string $gender
     * @return Builder
     */
    public function gender($gender)
    {
        $gender = json_decode($gender);
        return $this->builder->where('gender', $gender->id);
    }

    /**
     * Filter by province.
     *
     * @param  string $province
     * @return Builder
     */
    public function province($province)
    {
        $province = json_decode($province);
        return $this->builder->where('province_id', $province->id);
    }

    /**
     * Filter by city.
     *
     * @param  string $city
     * @return Builder
     */
    public function city($city)
    {
        $city = json_decode($city);
        return $this->builder->where('city_id', $city->id);
    }

    /**
     * Filter by grade.
     *
     * @param  string $grade
     * @return Builder
     */
    public function grade($grade)
    {
        $grade = json_decode($grade);
        return $this->builder->where('grade', $grade->id);
    }

    /**
     * Filter by field_of_study.
     *
     * @param  string $field_of_study
     * @return Builder
     */
    public function field_of_study($field_of_study)
    {
        $field_of_study = json_decode($field_of_study);
        return $this->builder->where('field_of_study', $field_of_study->id);
    }

    /**
     * Filter by payment_subject.
     *
     * @param  string $payment_subject
     * @return Builder
     */
    public function payment_subject($payment_subject)
    {
        $payment_subject = json_decode($payment_subject);
        return $this->builder->where('payment_subject', $payment_subject->id);
    }

}
