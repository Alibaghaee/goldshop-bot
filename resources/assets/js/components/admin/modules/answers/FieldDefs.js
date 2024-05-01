export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'creator_fullname',
      title: 'پاسخ دهنده',
      sortField: 'creator_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'body',
      title: 'متن پاسخ',
      sortField: 'body',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'long_substring'
    },
    {
      name: 'file',
      title: 'فایل',
      sortField: 'file',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: 'created_at',
      title: 'تاریخ ثبت پاسخ',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center fa-date'
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
