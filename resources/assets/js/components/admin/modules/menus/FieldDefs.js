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
      name: 'items_count',
      title: 'تعداد زیر منو',
      sortField: 'items_count',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'removable',
      title: 'قابلیت حذف',
      sortField: 'removable',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'lockLabel'
    },
    // {
    //   name: 'locale_name',
    //   title: 'زبان',
    //   sortField: 'locale_id',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
      name: '__component:menu-custom-actions',
      title: 'عملیات زیر منو ها',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
