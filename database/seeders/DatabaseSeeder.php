<?php


use Data\InvoicePortalsTableSeeder;
use Data\InvoiceBodyPortalsTableSeeder;
// {{dont_delete_this_comment_one}}
use Illuminate\Database\Seeder;

use Modules\InvoicePortalModuleTableSeeder;
// {{dont_delete_this_comment_two}}

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // modules

        $this->call(InvoicePortalModuleTableSeeder::class);
        // {{dont_delete_this_comment_three}}

        // data

        $this->call(InvoicePortalsTableSeeder::class);
        $this->call(InvoiceBodyPortalsTableSeeder::class);
        // {{dont_delete_this_comment_four}}
    }
}
