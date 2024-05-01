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
      dataClass: 'text-center'
    },
    // {
    //   name: 'refrence_id',
    //   title: 'شناسه پیگیری',
    //   sortField: 'refrence_id',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
      name: 'tabiat_product_title',
      title: 'محصول',
      sortField: 'tabiat_product_id',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'substring'
    },
    {
      name: 'status',
      title: 'وضعیت کد',
      sortField: 'status',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'tabiat_code_status'
    },
    {
      name: 'profile_id',
      title: 'شناسه پروفایل',
      sortField: 'profile_id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'utilization_date',
      title: 'تاریخ استفاده',
      sortField: 'utilization_date',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: 'created_at',
      title: 'تاریخ ایجاد',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: '__component:tabiat-code-custom-actions',
      title: 'عملیات',
      titleClass: 'text-center',
      dataClass: 'text-center',
    }

]
