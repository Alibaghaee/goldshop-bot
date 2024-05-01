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
      name: 'date',
      title: 'تاریخ نامه',
      sortField: 'date',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'file',
      title: 'پیوست',
      sortField: 'file',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: 'creator_fullname',
      title: 'ثبت کننده',
      sortField: 'creator_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: '__component:sended-letter-custom-actions',
      title: 'خروجی PDF',
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
