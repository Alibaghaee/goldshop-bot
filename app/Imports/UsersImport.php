<?php

namespace App\Imports;

use App\Models\General\Admin;
use App\Models\General\Domain;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToCollection
{


    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $name = explode(' ', $row[3]);
            $firstName = $name[0];
            unset($name[0]);
            $lastName = collect($name)->implode(' ');

            if ((!isset($row[5])) && ($row[5] === '0')) {
                return null;
            }
            if (!User::where('mobile', $row[5])->exists()) {


                if (($row[5] == 0 || (isset($row[5])))) {

                    $mobile = $row[5] ?? Str::uuid();
                } else {

                    $mobile = $row[5];
                }


                User::create([
                    'subscrip_code' => $row[1] ?? '0',
                    'provice_shahrdary' => $row[2] ?? '0',
                    'name' => $firstName,
                    'family' => $lastName,
                    'address' => $row[4],
                    'mobile' => '0' . $mobile,
                    'admin_id' => Admin::first()->id,
                    'password' => '$2y$10$EiA40TH28T97j8hUGh6LD.8IYj8nJmpu6gR4XlIMtN1nXK2jGIL2e',
                ]);
            }
        }
    }


}
