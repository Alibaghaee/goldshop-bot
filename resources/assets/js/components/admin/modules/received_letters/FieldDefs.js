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
      title: 'فایل',
      sortField: 'file',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
