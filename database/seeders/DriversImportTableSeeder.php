<?php

use App\Imports\DriversImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DriversImportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        Excel::import(new DriversImport(), __DIR__ . '/Imports/xlsx/drivers.xlsx');

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

    }
}
