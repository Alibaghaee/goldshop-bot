export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'id',
      title: 'شناسه',
      sortField: '_id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'sender',
      title: 'موبایل',
      sortField: 'sender',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'note',
      title: 'متن پیامک',
      sortField: 'note',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'tabiat_product_title',
      title: 'محصول',
      sortField: 'product_id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'tabiat_product_category_title',
      title: 'دسته محصول',
      sortField: 'product_catgory_id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'status',
      title: 'وضعیت پیامک',
      sortField: 'status',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'sms_recieve_status'
    },
    {
      name: 'code_state',
      title: 'وضعیت کد',
      sortField: 'code_state',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'sms_recieve_code_state'
    },
    {
      name: 'receiver',
      title: 'سرشماره',
      sortField: 'receiver',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'ignored',
      title: 'وضعیت حذف',
      sortField: 'ignored',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'deleted'
    },
    {
      name: 'sms_id',
      title: 'شناسه پیامک',
      sortField: 'sms_id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'created_at_fa',
      title: 'تاریخ',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    // {
    //   name: '__component:global-actions',
    //   title: 'عملیات',
    //   titleClass: 'text-center w-1/5',
    //   dataClass: 'text-center',
    // }

]
