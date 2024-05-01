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
      name: 'customer_fullname',
      title: 'مشتری',
      sortField: 'customer_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'description',
      title: 'توضیحات',
      sortField: 'description',
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
      name: 'is_pattern',
      title: 'الگو',
      sortField: 'is_pattern',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'boolean'
    },
    {
      name: '__component:contract-custom-actions',
      title: 'خروجی PDF',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/6',
      dataClass: 'text-center',
    }

]
