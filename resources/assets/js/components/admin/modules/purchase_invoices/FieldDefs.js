export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'description',
      title: 'توضیحات',
      sortField: 'description',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'substring'
    },
    {
      name: 'image',
      title: 'تصویر فاکتور',
      sortField: 'image',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: 'created_at',
      title: 'تاریخ ثبت',
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
