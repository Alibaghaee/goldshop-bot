<?php

namespace Data;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoicePortalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoice_portals = [
            [
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ],
        ];

        // DB::table('invoice_portals')->insert($invoice_portals);
    }
}
