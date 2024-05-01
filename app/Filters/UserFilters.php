<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class UserFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by name.
     *
     * @param string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Filter by family.
     *
     * @param string $family
     * @return Builder
     */
    public function family($family)
    {
        return $this->builder->where('family', 'like', '%' . $family . '%');
    }

    /**
     * Filter by mobile.
     *
     * @param string $mobile
     * @return Builder
     */
    public function mobile($mobile)
    {
        return $this->builder->where('mobile', 'like', '%' . $mobile . '%');
    }

    /**
     * Filter by phone.
     *
     * @param string $phone
     * @return Builder
     */
    public function phone($phone)
    {
        return $this->builder->where('phone', 'like', '%' . $phone . '%');
    }

    /**
     * Filter by emergency_mobile.
     *
     * @param string $emergency_mobile
     * @return Builder
     */
    public function emergency_mobile($emergency_mobile)
    {
        return $this->builder->where('emergency_mobile', 'like', '%' . $emergency_mobile . '%');
    }

    /**
     * Filter by national_code.
     *
     * @param string $national_code
     * @return Builder
     */
    public function national_code($national_code)
    {
        return $this->builder->where('national_code', 'like', '%' . $national_code . '%');
    }

    /**
     * Filter by subscrip_code.
     *
     * @param string $subscrip_code
     * @return Builder
     */
    public function subscrip_code($subscrip_code)
    {
        return $this->builder->where('subscrip_code', $subscrip_code);
    }

    /**
     * Filter by second_mobile.
     *
     * @param string $second_mobile
     * @return Builder
     */
    public function second_mobile($second_mobile)
    {
        return $this->builder->where('second_mobile', 'like', '%' . $second_mobile . '%');
    }

    /**
     * Filter by created_at min.
     *
     * @param string $created_at
     * @return Builder
     */
    public function created_at_min($created_at)
    {
        return $this->builder->whereDate('created_at', '>=', $created_at);
    }

    /**
     * Filter by created_at max.
     *
     * @param string $created_at
     * @return Builder
     */
    public function created_at_max($created_at)
    {
        return $this->builder->whereDate('created_at', '<=', $created_at);
    }

    /**
     * Filter by field.
     *
     * @param string $field
     * @return Builder
     */
    public function field($field)
    {
        $field = json_decode($field);
        return $this->builder->where('field', $field->id);
    }

    /**
     * Filter by gender.
     *
     * @param string $gender
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
     * @param string $province
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
     * @param string $city
     * @return Builder
     */
    public function city($city)
    {
        $city = json_decode($city);
        return $this->builder->where('city_id', $city->id);
    }

    /**
     * Filter by address.
     *
     * @param string $address
     * @return Builder
     */
    public function address($address)
    {
        return $this->builder->where('address', 'like', '%' . $address . '%');
    }

    /**
     * Apply the filters to the builder.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (!method_exists($this, $name) || empty($value)) {
                continue;
            }

            if (is_array($value)) {
                $value = json_encode($value);
            }
            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        if (count(array_intersect(['payment_filters_status', 'payment_created_at_min', 'payment_created_at_max', 'package'], array_keys($this->filters()))) > 0) {

            $this->builder->whereHas('purchases', function (Builder $query) use ($value, $name) {
                foreach ($this->filters() as $name => $value) {

                    if ($name == 'package' && !is_null($value)) {
                        $package = is_array($value) ? json_decode(json_encode((object)$value), FALSE) : json_decode($value);
                        $query->where('package_id', $package->id);
                    }

                    if ($name == 'payment_created_at_min' && !is_null($value)) {
                        $query->whereDate('created_at', '>=', $value);
                    }

                    if ($name == 'payment_created_at_max' && !is_null($value)) {
                        $query->whereDate('created_at', '<=', $value);
                    }

                    if ($name == 'payment_filters_status' && !is_null($value)) {
                        $status = is_array($value) ? json_decode(json_encode((object)$value), FALSE) : json_decode($value);

                        switch ($status->id) {
                            case 1:
                                $query->where('payed', true);
                                break;

                            case 2:
                                $query->where('payed', true)
                                    ->groupBy('user_id')
                                    ->where('type', 3);
                                break;

                            case 3:
                                $query->where('payed', true)
                                    ->groupBy('user_id')
                                    ->where('type', 1)
                                    ->whereRaw('user_id not in (select user_id from purchases where payed = ? and (type = ? or type = ?))', [true, 2, 3]);
                                break;

                            case 4:
                                $query->where('payed', true)
                                    ->where('type', 2);
                                break;

                            case 5:
                                $query->whereRaw('user_id not in (select user_id from purchases where payed = ?)', [true]);
                                break;

                            case 6:
                                $query->where('payed', true)
                                    ->groupBy('user_id')
                                    ->where(
                                        function ($query) {
                                            return $query
                                                ->where('type', 2)
                                                ->orWhere('type', 3);
                                        });

                                break;

                        }
                    }
                }
            });

        }

        return $this->builder;
    }

    /**
     * Filter by refund_filters_status.
     *
     * @param string $refund_filters_status
     * @return Builder
     */
    public function refund_filters_status($status)
    {
        $status = json_decode($status);

        switch ($status->id) {
            case 1:
                return $this->builder->where('iban', '!=', '')->whereNotNull('iban');
                break;

            case 2:
                return $this->builder->whereHas('refunds');
                break;

            case 3:
                return $this->builder->where('iban', '!=', '')->whereNotNull('iban')->whereDoesntHave('refunds');
                break;

            case 4:
                return $this->builder->where('iban', '')->orWhereNull('iban');
                break;

        }
    }

    /**
     * Filter by grade.
     *
     * @param string $grade
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
     * @param string $field_of_study
     * @return Builder
     */
    public function field_of_study($field_of_study)
    {
        $field_of_study = json_decode($field_of_study);
        return $this->builder->where('field_of_study', $field_of_study->id);
    }

}
