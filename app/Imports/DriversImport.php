<?php

namespace App\Imports;

use App\Models\General\Admin;
use App\Models\General\Driver;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DriversImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            if ((!isset($row[4])) && ($row[4] === '0')) {
                return null;
            }
            if (!Driver::where('mobile', $row[4])->exists()) {

                Driver::create([
                    'organization_code' => $row[3] ?? '0',
                    'first_name' => $row[1],
                    'last_name' => $row[2],
                    'mobile' => $row[4],
                    'admin_id' => Admin::first()->id,
                    'password' => '$2y$10$EiA40TH28T97j8hUGh6LD.8IYj8nJmpu6gR4XlIMtN1nXK2jGIL2e',
                ]);
            }
        }
    }

}
