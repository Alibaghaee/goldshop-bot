export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'title',
      title: 'عنوان',
      sortField: 'title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'discount_amount',
      title: 'میزان تخفیف',
      sortField: 'discount_amount',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'number_format',
    },
    // {
    //   name: 'is_percent',
    //   title: 'به درصد',
    //   sortField: 'is_percent',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'boolean',
    // },
    {
      name: 'count',
      title: 'تعداد',
      sortField: 'count',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'number_format',
    },
    // {
    //   name: 'max_uses',
    //   title: 'دفعات مجاز استفاده',
    //   sortField: 'max_uses',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'number_format',
    // },
    // {
    //   name: 'starts_at',
    //   title: 'تاریخ شروع',
    //   sortField: 'starts_at',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center ltr'
    // },
    // {
    //   name: 'expires_at',
    //   title: 'تاریخ انقضا',
    //   sortField: 'expires_at',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center ltr'
    // },
    {
      name: '__component:discount-custom-actions',
      title: 'کدهای تخفیف',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
