<?php

namespace Modules;

use App\Models\General\Module;
use App\Traits\Seeds\DataFill;
use Illuminate\Database\Seeder;

class InvoicePortalModuleTableSeeder extends Seeder
{
    use DataFill;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $default_actions_icon;

    public function __construct()
    {
        $this->default_actions_icon = '';
    }

    public function run()
    {
        $module_name     = 'invoice_portals';
        $controller_name = 'invoice_portals';
        $module_icon     = '';

        $module['module'] = [
            'title' => 'فاکتور',
            'name'  => $module_name,
            'icon'  => $module_icon,
        ];

        $module['controllers'] = [
            [
                'controller' => [
                    'name'    => $controller_name,
                    'title'   => 'فاکتور',
                    'icon'    => '',
                    'visible' => false,
                ],
                'actions'    => [
                    [
                        'name'    => 'index',
                        'title'   => 'لیست فاکتور',
                        'visible' => true,
                    ],
                    [
                        'name'    => 'create',
                        'title'   => 'ایجاد فاکتور',
                        'visible' => true,
                    ],
                    [
                        'name'  => 'show',
                        'title' => 'نمایش فاکتور',
                    ],
                    [
                        'name'  => 'edit',
                        'title' => 'ویرایش فاکتور',
                    ],
                    [
                        'name'  => 'destroy',
                        'title' => 'پاک کردن فاکتور',
                    ],
                ],
            ],
        ];

        $module = $this->dataFill($module);

        Module::createModule($module);
    }
}
