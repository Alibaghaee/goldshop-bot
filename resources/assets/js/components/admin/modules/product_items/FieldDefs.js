export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'w-8',
      dataClass: 'right aligned'
    },
    {
      name: 'title',
      title: 'عنوان',
      sortField: 'title',
      titleClass: 'text-right',
      dataClass: 'text-right'
    },
    {
      name: 'type_title',
      title: 'نوع',
      sortField: 'type',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    // {
    //   name: 'file',
    //   title: 'فایل',
    //   sortField: 'file',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'link'
    // },
    {
      name: 'active',
      title: 'وضعیت',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'activeLabel'
    },
    {
      name: 'order',
      title: 'ترتیب',
      sortField: 'order',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'track_count',
      title: 'تعداد نمایش',
      sortField: 'track_count',
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
