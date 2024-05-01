<?php

return [

    /**
     * levels id which has permission to all created actions
     */

    '5m5_db_connection' => 'mysql',

    'levels_with_all_permissions' => [1],

    'task_status' => [
        ['id' => 1, 'name' => 'انجام نشده'],
        ['id' => 2, 'name' => 'در حال انجام'],
        ['id' => 3, 'name' => 'انجام شده'],
    ],

    'report_status' => [
        ['id' => 1, 'name' => 'عدم ارسال'],
        ['id' => 2, 'name' => 'با تاخیر'],
        ['id' => 3, 'name' => 'به موقع'],
    ],

    'refer_status' => [
        ['id' => 0, 'name' => 'فعال'],
        ['id' => 1, 'name' => 'پایان یافته'],
    ],

    'customer_types' => [
        ['id' => 1, 'name' => 'حقیقی'],
        ['id' => 2, 'name' => 'حقوقی'],
    ],

    'sex' => [
        ['id' => 0, 'name' => 'زن'],
        ['id' => 1, 'name' => 'مرد'],
    ],

    //for menu create
    'menu_types' => [
        ['id' => 1, 'name' => 'ساده'],
        // ['id' => 2, 'name' => 'با تصویر'],
        // ['id' => 3, 'name' => 'با آیکن SVG'],
    ],

    'admins_email' => [
        'ceo@rahco.ir',
    ],

    'staff_category_id' => 1,
    'customer_groups_category_id' => 2,
    'how_know_types_category_id' => 3,

    // default local for loading template
    'default_local' => 'fa',

    'ticket_status' => [
        ['id' => 0, 'name' => 'در انتظار پاسخ'],
        ['id' => 1, 'name' => 'پاسخ درخواست گینده'],
        ['id' => 2, 'name' => 'پاسخ درخواست دهنده'],
        ['id' => 3, 'name' => 'در حال پیگیری'],
        ['id' => 4, 'name' => 'بسته شده'],
    ],

    'letter_sizes' => [
        ['id' => 2, 'name' => 'A5'],
        ['id' => 1, 'name' => 'A4'],
    ],

    'genders' => [
        ['id' => 0, 'name' => 'خانم'],
        ['id' => 1, 'name' => 'آقا'],
    ],

    'fields' => [
        ['id' => 1, 'name' => 'تجربی'],
        ['id' => 2, 'name' => 'ریاضی'],
        ['id' => 3, 'name' => 'انسانی'],
        ['id' => 4, 'name' => 'هنر'],
        ['id' => 5, 'name' => 'زبان'],
    ],

    'blacklist_price_for_admin' => 650, // Rial
    'blacklist_price_for_user' => 700, // Rial

    'blacklist_price_for_admin_single_send_type' => 1300, // Rial
    'blacklist_price_for_user_single_send_type' => 1500, // Rial

    'blacklist_types' => [
        ['id' => 0, 'name' => 'پیامکی'],
        ['id' => 1, 'name' => 'صوتی'],
    ],

    'blacklist_status' => [
        ['id' => 0, 'name' => 'در صف ارسال'],
        ['id' => 2, 'name' => 'کمبود شارژ'],
        ['id' => 1, 'name' => 'پایان یافته'],
    ],

    'blacklist_send_options' => [
        [
            'id' => 1,
            'name' => 'خروجی',
            'operator' => 'export',
            'limit_by_prefixes' => false,
            'allowed_mobile_prefixes_group' => [],
        ],
        [
            'id' => 3,
            'name' => '982100066381362',
            'operator' => '9821',
            'description' => 'متن های اطلاع رسانی',
            'limit_by_prefixes' => false,
            'allowed_mobile_prefixes_group' => [],
        ],
        [
            'id' => 4,
            'name' => '98210000000000001',
            'operator' => '9821',
            'description' => 'ایرانسل',
            'limit_by_prefixes' => true,
            'allowed_mobile_prefixes_group' => ['irancell'],
        ],
        [
            'id' => 5,
            'name' => '9890003561',
            'operator' => '9000',
            'description' => 'همراه اول',
            'limit_by_prefixes' => true,
            'allowed_mobile_prefixes_group' => ['mci'],
        ],
        [
            'id' => 6,
            'name' => '982100000',
            'operator' => '9821',
            'description' => 'ایرانسل - لینک --- لینک بررسی شود!',
            'limit_by_prefixes' => true,
            'allowed_mobile_prefixes_group' => ['irancell'],
        ],
    ],

    'mobile_prefixes' => [
        'irancell' => [
            '+98901', '+98902', '+98903', '+98904', '+98905', '+98930', '+98933', '+98935', '+98936', '+98937', '+98938', '+98939', '+98941',
        ],
        'mci' => [
            '+98910', '+98919', '+98990', '+98991', '+98992', '+98993', '+98994', '+98911', '+98912', '+98913', '+98914', '+98915', '+98916', '+98917', '+98918',
        ],
    ],

    'setting_id' => [
        'pre_purchase_price' => 6,
        'total_purchase_price' => 7,
        'supplementary_registration_status' => 8,
        'preroll_ads_video' => 34,
        'preroll_ads_link' => 35,
        'preroll_ads_skip_seconds' => 36,
        'player_logo' => 37,
        'ads_active' => 38,
        'header_logo' => 40,
        'register_page_image' => 41,
        'contact_info' => 42,
        'login_page_image' => 44,
    ],

    'payment_filters_status' => [
        ['id' => 1, 'name' => 'داوطلبان دارای پرداخت'],
        ['id' => 2, 'name' => 'داوطلبان تکمیل ثبت نام شده'],
        ['id' => 3, 'name' => 'داوطلبان تکمیل ثبت نام نشده'],
        ['id' => 4, 'name' => 'داوطلبان پرداخت ثبت نام یکجا'],
        ['id' => 5, 'name' => 'داوطلبان بدون هیچ پرداختی'],
        ['id' => 6, 'name' => 'داوطلبان تکمیل ثبت نام شده + پرداخت یکجا'],
    ],

    'monitoring_message_panel' => [
        'user_id' => 695271, // saeed user_id
        'admin_id' => 1,
    ],

    'blacklists_date_limit' => 1601554579,

    'cash_notify_voice_id' => 6586680,

    'backlist_insert_chucks_count' => 2000,

    'purchase_filters_status' => [
        ['id' => 1, 'name' => 'داوطلبان دارای پرداخت'],
        ['id' => 2, 'name' => 'داوطلبان تکمیل ثبت نام شده'],
        ['id' => 3, 'name' => 'داوطلبان تکمیل ثبت نام نشده'],
        ['id' => 4, 'name' => 'داوطلبان پرداخت ثبت نام یکجا'],
        ['id' => 5, 'name' => 'داوطلبان بدون هیچ پرداختی'],
        ['id' => 6, 'name' => 'داوطلبان تکمیل ثبت نام شده + پرداخت یکجا'],
    ],

    'fields_limit_setting_id' => [
        '1' => 21,
        '2' => 22,
        '3' => 23,
        '4' => 24,
        '5' => 25,
    ],

    'refund_filters_status' => [
        ['id' => 1, 'name' => 'متقاضیان بازگشت هزینه'],
        ['id' => 2, 'name' => 'بازگشت هزینه داده شده'],
        ['id' => 3, 'name' => 'بازگشت هزینه داده نشده'],
        ['id' => 4, 'name' => 'همه به جز متقاضیان بازگشت هزینه'],
    ],

    'grades' => [
        ['id' => 1, 'name' => 'ابتدایی - پایه اول'],
        ['id' => 2, 'name' => 'ابتدایی - پایه دوم'],
        ['id' => 3, 'name' => 'ابتدایی - پایه سوم'],
        ['id' => 4, 'name' => 'ابتدایی - پایه چهارم'],
        ['id' => 5, 'name' => 'ابتدایی - پایه پنجم'],
        ['id' => 6, 'name' => 'ابتدایی - پایه ششم'],
        ['id' => 7, 'name' => '(دوره اول) متوسطه - پایه هفتم'],
        ['id' => 8, 'name' => '(دوره اول) متوسطه - پایه هشتم'],
        ['id' => 9, 'name' => '(دوره اول) متوسطه - پایه نهم'],
        ['id' => 10, 'name' => '(دوره دوم) متوسطه - پایه دهم'],
        ['id' => 11, 'name' => '(دوره دوم) متوسطه - پایه یازدهم'],
        ['id' => 12, 'name' => '(دوره دوم) متوسطه - پایه دوازدهم'],
        ['id' => 13, 'name' => 'فارغ التحصیل'],
    ],

    'fields_of_study' => [
        ['id' => 1, 'name' => 'علوم تجربی'],
        ['id' => 2, 'name' => 'علوم ریاضی'],
        ['id' => 3, 'name' => 'علوم انسانی'],
        ['id' => 4, 'name' => 'هنرستان'],
        ['id' => 5, 'name' => 'هنر'],
        ['id' => 6, 'name' => 'زبان'],
        // ['id' => 7, 'name' => 'علوم و معارف اسلامی'],
        // ['id' => 8, 'name' => 'سایر موارد'],
    ],

    'locales' => [
        '1' => 'fa',
        '2' => 'en',
    ],
    'locales_option' => [
        ['id' => 1, 'name' => 'fa'],
        // ['id' => 2, 'name' => 'en'],
    ],

    'content_module_id' => 12,
    'product_module_id' => 30,
    'admin_module_id' => 1,
    'user_module_id' => 2,
    'setting_module_id' => 5,
    'category_module_id' => 6,
    'department_module_id' => 7,
    'menu_module_id' => 11,
    'gallery_module_id' => 13,
    'payment_module_id' => 27,
    'pay_module_id' => 28,
    'tag_module_id' => 31,
    'purchase_module_id' => 32,
    'contact_module_id' => 33,
    'discount_module_id' => 34,
    'package_module_id' => 35,
    'form_module_id' => 36,
    'selected_customer_module_id' => 54,

    'setting_types' => [
        ['id' => 1, 'name' => 'متن'],
        ['id' => 2, 'name' => 'فایل'],
    ],

    'menus' => [
        'fa' => [
            '1' => 1,
        ],
    ],

    // Price Unit = Rial
    'shipping_types' => [
        ['id' => 1, 'price' => 200000, 'name' => 'پست عادی'],
        ['id' => 2, 'price' => 300000, 'name' => 'پیشتاز'],
    ],

    'video_resolutions' => [
        'SD' => ['x' => '640', 'y' => '480'],
        'HD' => ['x' => '1280', 'y' => '720'],
        'FHD' => ['x' => '1920', 'y' => '1080'],
    ],

    'educational_content_types' => [
        ['id' => 1, 'name' => 'ویدئو'],
        ['id' => 2, 'name' => 'جزوه'],
    ],

    'products_parent_category_id' => 3,

    'payment_status' => [
        ['id' => 0, 'name' => 'ناموفق'],
        ['id' => 1, 'name' => 'موفق'],
    ],

    'purchase_status' => [
        ['id' => 1, 'name' => 'بازگشت هزینه'],
        ['id' => 2, 'name' => 'سایر موارد'],
    ],

    'finnotech_postal_code_refresh_token' => 'CzgiV57qZdQfOlmuDTTsNBaNliaQzuqpxEKpnKBtSiiYaJDut7TJ8EZn805QZzOEP922YJoW0gTr83W5Z0bd8BzQSzZCOGQccj5GTn5lDlpvsOlQNYTqrnQU6MZ32gmWC6xVsw42uwzYowYQG6BYwWmVTMJDrT0CDEyLlx3P2hKztzQtU38hUA6chudj1UbtVySubGnlVFlBSF6onLqLlVGUqtblnYlNYAp2GFiEBg5vhrWp2WgeYzM28KNhPxZB',

    'purchase_types' => [
        ['id' => 1, 'name' => 'پیش پرداخت'],
        ['id' => 2, 'name' => 'پرداخت یکجا'],
        ['id' => 3, 'name' => 'پرداخت تکمیلی'],
    ],

    'validation_rules' => [
        ['id' => 1, 'name' => 'ضروری', 'rule' => 'required'],
        ['id' => 1, 'name' => 'حداگثار 255 کراکتر', 'rule' => 'max:255'],
        ['id' => 1, 'name' => 'قبالیت خالی بودن', 'rule' => 'nullable'],
        ['id' => 1, 'name' => 'عددی باشد', 'rule' => 'numeric'],
        ['id' => 1, 'name' => 'استان معتبر باشد', 'rule' => 'exists:provinces,id'],
        ['id' => 1, 'name' => 'شهر معتبر باشذ', 'rule' => 'exists:cities,id'],
        ['id' => 1, 'name' => 'ده رقمس باشد', 'rule' => 'digits:10'],
        ['id' => 1, 'name' => 'حدا کثار 5000 کراکتر', 'rule' => 'max:5000'],
    ],

    'category_forms' => [
        // ['module_id' => 12, 'form' => 'content_form'],
        // ['module_id' => 30, 'form' => 'product_form'],
        // ['module_id' => 1, 'form' => 'admin_form'],
        // ['module_id' => 2, 'form' => 'user_form'],
        // ['module_id' => 5, 'form' => 'setting_form'],
        // ['module_id' => 6, 'form' => 'category_form'],
        // ['module_id' => 7, 'form' => 'department_form'],
        // ['module_id' => 11, 'form' => 'menu_form'],
        // ['module_id' => 13, 'form' => 'gallery_form'],
        // ['module_id' => 27, 'form' => 'payment_form'],
        // ['module_id' => 28, 'form' => 'pay_form'],
        // ['module_id' => 31, 'form' => 'tag_form'],
        // ['module_id' => 32, 'form' => 'purchase_form'],
        // ['module_id' => 33, 'form' => 'contact_form'],
        // ['module_id' => 34, 'form' => 'discount_form'],
        // ['module_id' => 35, 'form' => 'package_form'],
        ['module_id' => 36, 'form' => 'form_form'],
    ],

    'form' => [
        'field_types' => [
            ['id' => 1, 'name' => 'Input'],
            ['id' => 2, 'name' => 'Textarea'],
            ['id' => 3, 'name' => 'Select'],
            ['id' => 4, 'name' => 'Checkbox'],
        ],
    ],

    'form_fields_name' => [
        ['id' => 1, 'name' => 'email'],
        ['id' => 2, 'name' => 'mobile'],
        ['id' => 3, 'name' => 'phone'],
        ['id' => 4, 'name' => 'name'],
        ['id' => 5, 'name' => 'family'],
        ['id' => 6, 'name' => 'address'],
        // ['id' => 7, 'name' => 'birth_date'],
        ['id' => 8, 'name' => 'emergency_mobile'],
        ['id' => 9, 'name' => 'national_code'],
        ['id' => 10, 'name' => 'gender'],
        ['id' => 11, 'name' => 'field'],
        ['id' => 12, 'name' => 'province_id'],
        ['id' => 13, 'name' => 'city_id'],
        ['id' => 14, 'name' => 'iban'],
        // ['id' => 15, 'name' => 'iban_meta'],
        ['id' => 16, 'name' => 'grade'],
        ['id' => 17, 'name' => 'field_of_study'],
        ['id' => 18, 'name' => 'postal_code'],
        // ['id' => 19, 'name' => 'data'],
        ['id' => 20, 'name' => 'description'],
    ],

    'sms_receive' => [
        'status' => [
            ['id' => 0, 'name' => 'بررسی نشده'],
            ['id' => 1, 'name' => 'بررسی شده'],
        ],
        'code_state' => [
            ['id' => 1, 'name' => 'معتبر'],
            ['id' => 2, 'name' => 'نامعتبر'],
            ['id' => 3, 'name' => 'تکراری'],
        ],
    ],

    'tabiat_code' => [
        'status' => [
            ['id' => 0, 'name' => 'استفاده نشده'],
            ['id' => 1, 'name' => 'استفاده شده'],
        ],
    ],

    'report' => [
        'chart_types' => [
            ['id' => 1, 'name' => 'نمودار ماهانه میله ای و خطی'],
            ['id' => 2, 'name' => 'نمودار ساعتی میله ای وخطی'],
            ['id' => 3, 'name' => 'نمودار دایره ای محصولات'],
        ],
        'status' => [
            ['id' => 0, 'name' => 'بدون وضعیت'],
            ['id' => 1, 'name' => 'در حال اجرا'],
            ['id' => 2, 'name' => 'آماده شده'],
        ],
    ],

    'lottery_one' => [
        'status' => [
            ['id' => 0, 'name' => 'بدون وضعیت'],
            ['id' => 1, 'name' => 'در حال آماده سازی'],
            ['id' => 2, 'name' => 'موفق'],
            ['id' => 3, 'name' => 'ناموفق'],
        ],
    ],

    'selected_customer' => [
        'shop_grades' => [
            ['id' => 1, 'name' => 'A'],
            ['id' => 2, 'name' => 'A+'],
            ['id' => 3, 'name' => 'B'],
            ['id' => 4, 'name' => 'B+'],
        ],
        'shop_pakhors' => [
            ['id' => 1, 'name' => 'خلوت'],
            ['id' => 2, 'name' => 'متوسط'],
            ['id' => 3, 'name' => 'شلوغ'],
        ],
        'shop_ownership_status' => [
            ['id' => 1, 'name' => 'مالک'],
            ['id' => 2, 'name' => 'مستاجر'],
        ],
        'status' => [
            ['id' => 1, 'name' => 'تایید شده'],
            ['id' => 2, 'name' => 'تایید نشده'],
        ],
        'shop_has_sign' => [
            ['id' => 1, 'name' => 'دارد'],
            ['id' => 0, 'name' => 'ندارد'],
        ],
        'cooperation_status' => [
            ['id' => 1, 'name' => 'دارد'],
            ['id' => 0, 'name' => 'ندارد'],
        ],

    ],
    'promotional_items' => [
        ['id' => 0, 'name' => 'دنگلر'],
        ['id' => 1, 'name' => 'وابلر'],
        ['id' => 2, 'name' => 'مش'],
        ['id' => 3, 'name' => 'استیکر'],
        ['id' => 4, 'name' => 'تابلو'],
        ['id' => 5, 'name' => 'شلف تاکر'],
    ]

];
