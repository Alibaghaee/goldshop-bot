export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'code',
      title: 'کد',
      sortField: 'code',
      titleClass: 'text-center',
      dataClass: 'font-sans text-center'
    },
    // {
    //   name: 'discount_amount',
    //   title: 'میزان تخفیف',
    //   sortField: 'discount_amount',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'number_format',
    // },
    // {
    //   name: 'is_percent',
    //   title: 'به درصد',
    //   sortField: 'is_percent',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'boolean',
    // },
    // {
    //   name: 'max_uses',
    //   title: 'دفعات مجاز استفاده',
    //   sortField: 'max_uses',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'number_format',
    // },
    // {
    //   name: 'uses',
    //   title: 'دفعات استفاده',
    //   sortField: 'uses',
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
    // }
    {
      name: 'is_over_max_uses',
      title: 'معتبر',
      sortField: 'is_over_max_uses',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'isOverMaxUses',
    },    

]
