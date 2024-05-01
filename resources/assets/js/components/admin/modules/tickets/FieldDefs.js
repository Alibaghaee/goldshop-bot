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
      name: 'creator_fullname',
      title: 'ثبت کننده',
      sortField: 'creator_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'receiver_fullname',
      title: 'دریافت کننده',
      sortField: 'receiver_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'created_at',
      title: 'تاریخ ثبت',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center fa-date'
    },
    // {
    //   name: 'updated_at',
    //   title: 'تاریخ آخرین بروزرسانی',
    //   sortField: 'updated_at',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center fa-date'
    // },
    {
      name: 'file',
      title: 'فایل',
      sortField: 'file',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: 'status_title',
      title: 'وضعیت',
      sortField: 'status_title',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'items_count',
      title: 'تعداد پاسخ ها',
      sortField: 'items_count',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: '__component:ticket-custom-actions',
      title: 'پاسخ',
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
