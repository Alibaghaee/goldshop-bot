<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => ':attribute باید پذیرفته شده باشد.',
    'active_url'           => 'آدرس :attribute معتبر نیست',
    'after'                => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal'       => ':attribute باید تاریخی بعد از :date، یا مطابق با آن باشد.',
    'alpha'                => ':attribute باید فقط حروف الفبا باشد.',
    'alpha_dash'           => ':attribute باید فقط حروف الفبا، عدد و خط تیره(-) باشد.',
    'alpha_num'            => ':attribute باید فقط حروف الفبا و عدد باشد.',
    'array'                => ':attribute باید آرایه باشد.',
    'before'               => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal'      => ':attribute باید تاریخی قبل از :date، یا مطابق با آن باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید بین :min و :max آیتم باشد.',
    ],
    'boolean'              => 'فیلد :attribute فقط می‌تواند صحیح و یا غلط باشد',
    'confirmed'            => ':attribute با فیلد تکرار مطابقت ندارد.',
    'date'                 => ':attribute یک تاریخ معتبر نیست.',
    'date_format'          => ':attribute با الگوی :format مطاقبت ندارد.',
    'different'            => ':attribute و :other باید متفاوت باشند.',
    'digits'               => ':attribute باید :digits رقم باشد.',
    'digits_between'       => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => 'ابعاد تصویر :attribute قابل قبول نیست.',
    'distinct'             => 'فیلد :attribute تکراری است.',
    'email'                => ':attribute باید یک ایمیل معتبر باشد',
    'exists'               => ':attribute انتخاب شده، معتبر نیست.',
    'file'                 => ':attribute باید یک فایل باشد',
    'filled'               => 'فیلد :attribute الزامی است',
    'gt'                   => [
        'numeric' => ':attribute باید بزرگتر از :value باشد',
        'file'    => ':attribute باید بزرگتر از :value کیلوبایت باشد',
        'string'  => ':attribute باید بزرگتر از :value کاراکتر باشد',
        'array'   => ':attribute باید بزرگتر از :value آیتم باشد',
    ],
    'gte'                  => [
        'numeric' => ':attribute باید بزرگتر یا مساوی از :value باشد',
        'file'    => ':attribute باید بزرگتر یا مساوی از :value کیلوبایت باشد',
        'string'  => ':attribute باید بزرگتر یا مساوی از :value کاراکتر باشد',
        'array'   => ':attribute باید بزرگتر یا مساوی از :value آیتم باشد',
    ],
    'image'                => ':attribute باید تصویر باشد.',
    'in'                   => ':attribute انتخاب شده، معتبر نیست.',
    'in_array'             => 'فیلد :attribute در :other وجود ندارد.',
    'integer'              => ':attribute باید عدد صحیح باشد.',
    'ip'                   => ':attribute باید IP معتبر باشد.',
    'ipv4'                 => ':attribute باید یک آدرس معتبر از نوع IPv4 باشد.',
    'ipv6'                 => ':attribute باید یک آدرس معتبر از نوع IPv6 باشد.',
    'json'                 => 'فیلد :attribute باید یک رشته از نوع JSON باشد.',
    'lt'                   => [
        'numeric' => ':attribute باید کوچکتر از :value باشد',
        'file'    => ':attribute باید کوچکتر از :value کیلوبایت باشد',
        'string'  => ':attribute باید کوچکتر از :value کاراکتر باشد',
        'array'   => ':attribute باید کوچکتر از :value آیتم باشد',
    ],
    'lte'                  => [
        'numeric' => ':attribute باید کوچکتر یا مساوی از :value باشد',
        'file'    => ':attribute باید کوچکتر یا مساوی از :value کیلوبایت باشد',
        'string'  => ':attribute باید کوچکتر یا مساوی از :value کاراکتر باشد',
        'array'   => ':attribute باید کوچکتر یا مساوی از :value آیتم باشد',
    ],
    'max'                  => [
        'numeric' => ':attribute نباید بزرگتر از :max باشد.',
        'file'    => ':attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :max آیتم باشد.',
    ],
    'mimes'                => ':attribute باید یکی از فرمت های :values باشد.',
    'mimetypes'            => ':attribute باید یکی از فرمت های :values باشد.',
    'min'                  => [
        'numeric' => ':attribute نباید کوچکتر از :min باشد.',
        'file'    => ':attribute نباید کوچکتر از :min کیلوبایت باشد.',
        'string'  => ':attribute نباید کمتر از :min کاراکتر باشد.',
        'array'   => ':attribute نباید کمتر از :min آیتم باشد.',
    ],
    'not_in'               => ':attribute انتخاب شده، معتبر نیست.',
    'not_regex'            => 'فرمت :attribute معتبر نیست.',
    'numeric'              => ':attribute باید عدد باشد.',
    'present'              => 'فیلد :attribute باید در پارامترهای ارسالی وجود داشته باشد.',
    'regex'                => 'فرمت :attribute معتبر نیست',
    'required'             => 'فیلد :attribute الزامی است',
    'required_if'          => 'هنگامی که :other برابر با :value است، فیلد :attribute الزامی است.',
    'required_unless'      => 'فیلد :attribute ضروری است، مگر آنکه :other در :values موجود باشد.',
    'required_with'        => 'در صورت وجود فیلد :values، فیلد :attribute الزامی است.',
    'required_with_all'    => 'در صورت وجود فیلدهای :values، فیلد :attribute الزامی است.',
    'required_without'     => 'در صورت عدم وجود فیلد :values، فیلد :attribute الزامی است.',
    'required_without_all' => 'در صورت عدم وجود هر یک از فیلدهای :values، فیلد :attribute الزامی است.',
    'same'                 => ':attribute و :other باید مانند هم باشند.',
    'size'                 => [
        'numeric' => ':attribute باید برابر با :size باشد.',
        'file'    => ':attribute باید برابر با :size کیلوبایت باشد.',
        'string'  => ':attribute باید برابر با :size کاراکتر باشد.',
        'array'   => ':attribute باسد شامل :size آیتم باشد.',
    ],
    'string'               => 'فیلد :attribute باید متن باشد.',
    'timezone'             => 'فیلد :attribute باید یک منطقه زمانی قابل قبول باشد.',
    'unique'               => ':attribute قبلا انتخاب شده است.',
    'uploaded'             => 'آپلود فایل :attribute موفقیت آمیز نبود.',
    'url'                  => 'فرمت آدرس :attribute اشتباه است.',
    'captcha'              => ':attribute را اشتباه وارد نموده اید.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'level_id.id'             => [
            'required' => 'فیلد سطح دسترسی الزامی است.',
            'in'       => 'فیلد سطح دسترسی معتبر نیست.',
        ],
        'role_id.id'              => [
            'required' => 'فیلد نقش کاربری الزامی است.',
            'in'       => 'فیلد نقش کاربری معتبر نیست.',
        ],
        'category_id.id'          => [
            'required' => 'فیلد گروه الزامی است.',
            'in'       => 'فیلد گروه معتبر نیست.',
        ],
        'category_item_id.id'     => [
            'required' => 'فیلد زیر گروه الزامی است.',
            'in'       => 'فیلد زیر گروه معتبر نیست.',
        ],
        'locale_id.id'            => [
            'required' => 'فیلد زبان الزامی است.',
            'in'       => 'فیلد زبان معتبر نیست.',
        ],
        'transportation_type.id'  => [
            'required' => 'فیلد نوع وسیله حمل الزامی است.',
            'in'       => 'فیلد نوع وسیله حمل معتبر نیست.',
        ],
        'assigned_to_admin_id.id' => [
            'required' => 'فیلد دریافت کننده الزامی است.',
            'in'       => 'فیلد دریافت کننده معتبر نیست.',
        ],
        'status.id'               => [
            'required' => 'فیلد وضعیت الزامی است.',
            'in'       => 'فیلد وضعیت معتبر نیست.',
        ],
        'to_admin_id.id'          => [
            'required' => 'فیلد ارجاع شونده الزامی است.',
            'in'       => 'فیلد ارجاع شونده معتبر نیست.',
        ],
        'module_id.id'            => [
            'required' => 'فیلد امکان الزامی است.',
            'in'       => 'فیلد امکان معتبر نیست.',
        ],
        'type.id'                 => [
            'required' => 'فیلد نوع الزامی است.',
            'in'       => 'فیلد نوع معتبر نیست.',
        ],
        'group.id'                => [
            'required' => 'فیلد گروه الزامی است.',
            'in'       => 'فیلد گروه معتبر نیست.',
        ],
        'how_know.id'             => [
            'required' => 'فیلد نحوه آشنایی الزامی است.',
            'in'       => 'فیلد نحوه آشنایی معتبر نیست.',
        ],
        'sex.id'                  => [
            'required'    => 'فیلد جنسیت الزامی است.',
            'in'          => 'فیلد جنسیت معتبر نیست.',
            'required_if' => 'فیلد جنسیت الزامی است.',
        ],
        'sender.id'               => [
            'required' => 'فیلد درگاه ارسال الزامی است.',
            'in'       => 'فیلد درگاه ارسال معتبر نیست.',
        ],
        'name'                    => [
            'required_if' => 'فیلد نام الزامی است.',
        ],
        'family'                  => [
            'required_if' => 'فیلد نام خانوادگی الزامی است.',
        ],
        'company_name'            => [
            'required_if' => 'فیلد نام شرکت الزامی است.',
        ],
        'payment_description'     => [
            'required_if' => 'فیلد شرح پرداخت الزامی است.',
        ],
        'form_id.id'              => [
            'required' => 'فیلد فرم الزامی است.',
            'in'       => 'فیلد فرم معتبر نیست.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
     */

    'attributes'           => [
        'name'                  => 'نام',
        'username'              => 'نام کاربری',
        'email'                 => 'ایمیل',
        'first_name'            => 'نام',
        'last_name'             => 'نام خانوادگی',
        'password'              => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
        'city'                  => 'شهر',
        'country'               => 'کشور',
        'address'               => 'نشانی',
        'phone'                 => 'تلفن ثابت',
        'mobile'                => 'تلفن همراه',
        'age'                   => 'سن',
        'sex'                   => 'جنسیت',
        'gender'                => 'جنسیت',
        'day'                   => 'روز',
        'month'                 => 'ماه',
        'year'                  => 'سال',
        'hour'                  => 'ساعت',
        'minute'                => 'دقیقه',
        'second'                => 'ثانیه',
        'title'                 => 'عنوان',
        'text'                  => 'متن',
        'content'               => 'محتوا',
        'description'           => 'توضیحات',
        'excerpt'               => 'گزیده مطلب',
        'date'                  => 'تاریخ',
        'time'                  => 'زمان',
        'available'             => 'موجود',
        'size'                  => 'اندازه',
        'terms'                 => 'شرایط',
        'province'              => 'استان',

        'role_id'               => 'نقش کابری',
        'level_id'              => 'سطح دسترسی',
        'family'                => 'نام خانوادگی',
        'avatar'                => 'تصویر پروفایل',
        'link'                  => 'پیوند',
        'depth'                 => 'عمق',
        'menu_type'             => 'نوع منو',

        'address_slug'          => 'عنوان (uri)',
        'captcha'               => 'کد امنیتی',

        'request_info'          => 'مشخصات و نشانی متقاضی',
        'product_type'          => 'نوع کالا',
        'packing_type'          => 'نوع بسته بندی',
        'weight'                => 'وزن تقریبی کالا',
        'volume'                => 'حجم تقریبی کالا',
        'origin'                => 'مبدا',
        'destination'           => 'مقصد',
        'preparation_time'      => 'زمان تقریبی آمادگی کالا برای بارگیری',
        'captcha'               => 'کد امنیتی',
        'fullname'              => 'نام مسئول پیگیری',

        'start_date'            => 'تاریخ',
        'deadline'              => 'مهلت',
        'reported_at'           => 'زمان گزارش',
        'report_description'    => 'گزارش فعالیت',

        'enter_time'            => 'ساعت ورود',
        'exit_time'             => 'ساعت خروج',
        'document'              => 'مدارک',
        'category_item_id'      => 'گروه',

        'type'                  => 'نوع',
        'group_id'              => 'گروه',
        'postal_code'           => 'کد پستی',
        'email'                 => 'ایمیل',
        'phone'                 => 'تلفن',
        'fax'                   => 'فکس',
        'website'               => 'سایت',
        'how_know_id'           => 'نحوه آشنایی',
        'company_name'          => 'نام شرکت',
        'economic_code'         => 'کد اقتصادی',
        'company_national_code' => 'شناسه ملی شرکت',
        'register_id'           => 'شناسه ثبت',
        'father_name'           => 'نام پدر',
        'national_code'         => 'کد ملی',
        'id_number'             => 'شماره شناسنامه',
        'place'                 => 'محل تولد',
        'birth_date'            => 'تاریخ تولد',
        'user_price'            => 'قیمت کاربر',
        'admin_price'           => 'قیمت مدیر',
        'confirm'               => 'تایید',
        'field.id'              => 'رشته',
        'gender.id'             => 'جنسیت',
        'province_id.id'        => 'استان',
        'city_id.id'            => 'شهر',
        'emergency_mobile'      => 'تلفن همراه یکی از بستگان یا اولیاء داوطلب',
        'iban'                  => 'شناسه شبا',
        'account_owner'         => 'نام و نام خانوادگی صاحب حساب',
        'family_relationship'   => 'نسبت خانوادگی',
        'bank_name'             => 'نام بانک',
        'grade.id'              => 'مقطع تحصیلی',
        'field_of_study.id'     => 'رشته تحصیلی',
        'payment_subject.id'    => 'موضوع پرداخت',
        'payment_description'   => 'شرح پرداخت',
        'price'                 => 'مبلغ',
        'code'                  => 'کد',
        'discount_amount'       => 'میزان تخفیف',
        'is_percent'            => 'به درصد باشد؟',
        'count'                 => 'تعداد کد',
        'code'                  => 'کد',
        'max_uses'              => 'دفعات مجاز استفاده',
        'starts_at'             => 'تاریخ شروع',
        'expires_at'            => 'تاریخ انقضا',
        'image'                 => 'تصویر',
        'cover'                 => 'کاور',
        'info'                  => 'اطلاعات',
        'first_description'     => 'توضیحات بخش اول ثبت نام',
        'second_description'    => 'توضیحات بخش دوم ثبت نام',
        'agreement_text'        => 'تعهد نامه و خدمات',
        'allow_installment'     => 'قسطی',
        'pre_payment'           => 'مبلغ پیش پرداخت',
        'full_payment_message'  => 'متن رسید پرداخت (پرداخت کامل)',
        'pre_payment_message'   => 'متن رسید پرداخت (پیش پرداخت)',
        'note'                  => 'متن',
        'length'                => 'تعداد ارقام کد',
        'tabiat_product_id.id'  => 'محصول',
        'codes'                 => 'کدها',
    ],
];
