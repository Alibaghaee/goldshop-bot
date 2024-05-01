<?php

namespace App\Repository;

use App\Models\General\SmsReceive;
use Illuminate\Support\Facades\Cache;
use Morilog\Jalali\Jalalian;

class SmsReceiveRepository extends SmsReceive
{
    public function scopeReportByHour($query, $options = [], $limit = 6000000)
    {
        $aggregateBy = [
            ['$sort' => ["created_at" => -1]],
            ['$limit' => $limit],
            [
                '$project' => [
                    "y" => [
                        '$year' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "m" => [
                        '$month' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "d" => [
                        '$dayOfMonth' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "h" => [
                        '$hour' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                ],
            ],
            [
                '$group' => [
                    "_id"   => [
                        "year"  => '$y',
                        "month" => '$m',
                        "day"   => '$d',
                        "hour"  => '$h',
                    ],
                    "count" => ['$sum' => 1],
                ],
            ],
            [
                '$sort' => [
                    "_id.month" => 1,
                    "_id.day"   => 1,
                    "_id.hour"  => 1,
                ],
            ],
        ];

        return $this->handle($query, $aggregateBy);
    }

    public function scopeReportByDay($query, $options = [], $limit = 6000000)
    {
        $aggregateBy = [
            ['$sort' => ["created_at" => -1]],
            ['$limit' => $limit],
            [
                '$project' => [
                    "date" => [
                        '$dateToString' => [
                            "format"   => "%Y-%m-%d",
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "y"    => [
                        '$year' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "m"    => [
                        '$month' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "d"    => [
                        '$dayOfMonth' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                ],
            ],
            [
                '$group' => [
                    "_id"   => [
                        "date"  => '$date',
                        "year"  => '$y',
                        "month" => '$m',
                        "day"   => '$d',
                    ],
                    "count" => ['$sum' => 1],
                ],
            ],
            [
                '$sort' => [
                    "_id.month" => 1,
                    "_id.day"   => 1,
                    "_id.hour"  => 1,
                ],
            ],
        ];

        $aggregateBy = count($options) ? array_prepend($aggregateBy, $options) : $aggregateBy;

        $result = $this->handle($query, $aggregateBy);
        $result = json_decode(json_encode($result));
        $result = $this->convertToJalali($result);

        return $result;
    }

    public function scopeReportByDayGroupMonthly($query, $options = [])
    {
        // need refactory ;)
        $reports = $query->reportByDay($options);
        $reports = $reports->groupBy('jalali_date.month');

        $report_with_compelete_month_days = $this->compeleteMonthDays($reports);

        $multiple_data = [];

        foreach ($report_with_compelete_month_days as $index => $report) {
            $labels = [];
            $data   = [];
            foreach ($report as $item) {
                $label    = $index;
                $labels[] = $item['jalali_date']['day'];
                $data[]   = $item['count'];
            }
            $multiple_data[] = [
                'index'    => $item['jalali_date']['year'] . '-' . $item['jalali_date']['month'],
                'labels'   => $labels,
                'data'     => $data,
                'month'    => $item['jalali_date']['month'],
                'data_sum' => array_sum($data),
            ];
        }

        return $multiple_data;
    }

    public function scopeReportByMonth($query, $options = [], $limit = 6000000)
    {
        $aggregateBy = [
            ['$sort' => ["created_at" => -1]],
            ['$limit' => $limit],
            [
                '$project' => [
                    "y" => [
                        '$year' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                    "m" => [
                        '$month' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                ],
            ],
            [
                '$group' => [
                    "_id"   => [
                        "year"  => '$y',
                        "month" => '$m',
                    ],
                    "count" => ['$sum' => 1],
                ],
            ],
            [
                '$sort' => [
                    "_id.month" => 1,
                    "_id.day"   => 1,
                    "_id.hour"  => 1,
                ],
            ],
        ];

        return $this->handle($query, $aggregateBy);
    }

    public function scopeReportIn24Hour($query, $options = [], $limit = 6000000)
    {
        $aggregateBy = [
            ['$sort' => ["created_at" => -1]],
            ['$limit' => $limit],
            [
                '$project' => [
                    "h" => [
                        '$hour' => [
                            "date"     => '$created_at',
                            "timezone" => "Asia/Tehran",
                        ],
                    ],
                ],
            ],
            [
                '$group' => [
                    "_id"   => ["hour" => '$h'],
                    "count" => ['$sum' => 1],
                ],
            ],
            ['$sort' => ["_id.hour" => 1]],
        ];

        $aggregateBy = count($options) ? array_prepend($aggregateBy, $options) : $aggregateBy;

        return $this->handle($query, $aggregateBy);
    }

    public function scopeReportByProduct($query, $options = [], $limit = 6000000)
    {
        $aggregateBy = [
            [
                '$match' => [
                    'tabiat_product_id' => ['$exists' => true],
                ],
            ],
            ['$sort' => ["created_at" => -1]],
            ['$limit' => $limit],
            [
                '$project' => [
                    "tabiat_product_id" => '$tabiat_product_id',
                ],
            ],
            [
                '$group' => [
                    "_id"   => ["tabiat_product_id" => '$tabiat_product_id'],
                    "count" => ['$sum' => 1],
                ],
            ],
            ['$sort' => ["count" => -1]],
        ];

        $aggregateBy = count($options) ? array_prepend($aggregateBy, $options) : $aggregateBy;

        return $this->handle($query, $aggregateBy);
    }

    protected function handle($query, $aggregateBy)
    {
        $key = md5(print_r($aggregateBy, true));

        $result = Cache::remember($key, 24 * 60, function () use ($query, $aggregateBy) {
            return $query
                ->raw(function ($collection) use ($aggregateBy) {
                    return $collection->aggregate($aggregateBy, ["allowDiskUse" => true]);
                });
        });

        return $result;
    }

    protected function convertToJalali($data)
    {
        foreach ($data as $item) {
            $item->jalali_date = [
                'date'  => Jalalian::fromDateTime($item->_id->date)->format('Y-m-d'),
                'year'  => (int) Jalalian::fromDateTime($item->_id->date)->format('Y'),
                'month' => (int) Jalalian::fromDateTime($item->_id->date)->format('m'),
                'day'   => (int) Jalalian::fromDateTime($item->_id->date)->format('d'),
            ];
        }
        $data = json_decode(json_encode($data, true));
        return collect($data);
    }

    protected function compeleteMonthDays($reports)
    {
        foreach ($reports as $report) {
            $exists_days     = $report->pluck('jalali_date.day');
            $not_exists_days = $this->fullMonthDaysList()->diff($exists_days);
            $sample          = (object) (array) $report->first();

            foreach ($not_exists_days as $not_exists_day) {
                $report->push($this->generateRecord($sample, $not_exists_day));
            }
        }

        return $this->sortByDay($reports);
    }

    protected function fullMonthDaysList()
    {
        return collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]);
    }

    public function sortByDay($data)
    {
        $reports        = json_decode(json_encode($data->toArray()), true);
        $sorted_reports = [];

        foreach ($reports as $key => $report) {
            $sorted_report = [];
            foreach ($report as $item) {
                $sorted_report[$item['jalali_date']['day']] = $item;
            }
            ksort($sorted_report);
            $sorted_reports[$key] = $sorted_report;
        }

        return collect($sorted_reports);
    }

    protected function generateRecord($sample, $day)
    {
        $year         = $sample->jalali_date->year;
        $month        = $sample->jalali_date->month;
        $string_day   = (strlen($day) == 1 ? '0' . $day : $day);
        $string_month = (strlen($month) == 1 ? '0' . $month : $month);

        return [
            'count'       => 0,
            'jalali_date' => [
                'date'  => $year . '-' . $string_month . '-' . $string_day,
                'year'  => $year,
                'month' => $month,
                'day'   => $day,
            ],
        ];
    }

    public static function getDataByCriteria($aggregations = [], $skip = 0, $limit = 60)
    {
        $aggregateBy = $aggregateBy = [
            ['$sort' => ["created_at" => -1]],
            ['$skip' => $skip],
            ['$limit' => $limit],
        ];

        $aggregateBy = count($aggregations) ? array_prepend($aggregateBy, $aggregations) : $aggregateBy;

        return static::raw(function ($collection) use ($aggregateBy) {
            return $collection->aggregate($aggregateBy, ["allowDiskUse" => true]);
        });
    }

    public static function getCountByCriteria($aggregations = [])
    {
        $aggregateBy = [
            ['$sort' => ["created_at" => -1]],
            [
                '$group' => [
                    "_id"   => null,
                    "count" => ['$sum' => 1],
                ],
            ],
        ];

        $aggregateBy = count($aggregations) ? array_prepend($aggregateBy, $aggregations) : $aggregateBy;

        $result = static::raw(function ($collection) use ($aggregateBy) {
            return $collection->aggregate($aggregateBy, ["allowDiskUse" => true]);
        });

        return optional($result->first())->count;
    }

}
