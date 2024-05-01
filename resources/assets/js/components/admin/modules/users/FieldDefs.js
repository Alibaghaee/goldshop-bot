export default [
    {
        name: '__sequence',
        title: '#',
        titleClass: 'w-8',
        dataClass: 'right aligned'
    },
    // {
    //   name: '__handle',   // <----
    //   title: '*********',
    //   dataClass: 'h-6 w-6 bg-grey'
    // },
    // {
    //   name: '__checkbox',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
        name: 'subscrip_code',
        title: 'کداشتراک',
        sortField: 'subscrip_code',
        titleClass: 'text-right',
        dataClass: 'text-right'
    },
    {
        name: 'name',
        title: 'نام',
        sortField: 'name',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    {
        name: 'family',
        title: 'نام خانوادگی',
        sortField: 'family',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    // {
    //     name: 'national_code',
    //     title: 'کد ملی',
    //     sortField: 'national_code',
    //     titleClass: 'text-center',
    //     dataClass: 'text-center'
    // },
    {
        name: 'mobile',
        title: 'موبایل',
        sortField: 'mobile',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    {
        name: 'second_mobile',
        title: 'موبایل دوم',
        sortField: 'second_mobile',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    {
        name: 'wallet',
        title: 'شارژ',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'formatNumber'
    }, {
        name: 'total_purchases_price',
        title: 'مجموع پرداخت (ریال)',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'formatNumber'
    },
    {
        name: 'created_at_fa',
        title: 'تاریخ ایجاد کاربر',
        sortField: 'created_at',
        titleClass: 'text-center',
        dataClass: 'text-center ltr'
    },
    // {
    //   name: 'refunds_count',
    //   title: 'بازگشت هزینه',
    //   sortField: 'refunds_count',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'refund'
    // },
    // {
    //   name: 'username',
    //   title: 'نام کاربری',
    //   sortField: 'username',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    // {
    //   name: 'birthdate',
    //   title: 'تاریخ تولد',
    //   sortField: 'birthdate',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'formatDate|DD-MM-YYYY'
    // },
    // {
    //   name: 'gender',
    //   title: 'عنوان',
    //   sortField: 'gender',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'genderLabel'
    // },
    // {
    //   name: '__slot:actions',
    //   title: 'عملیات',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
        name: '__component:user-custom-actions',
        title: 'پرداخت ها',
        titleClass: 'text-center',
        dataClass: 'text-center',
    },
    {
        name: '__component:global-actions',
        title: 'عملیات',
        titleClass: 'text-center',
        dataClass: 'text-center',
    }
]
