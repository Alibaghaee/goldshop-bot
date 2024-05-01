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
      name: 'active',
      title: 'وضعیت',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'activeLabel'
    },
    // {
    //   name: 'code',
    //   title: 'کد',
    //   sortField: 'code',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
      name: 'price',
      title: 'قیمت',
      sortField: 'price',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'items_count',
      title: 'تعداد پیوست ها',
      sortField: 'items_count',
      titleClass: 'text-center w-48',
      dataClass: 'text-center w-48'
    },
    {
      name: '__component:product-custom-actions',
      title: 'عملیات پیوست ها',
      titleClass: 'text-center w-48',
      dataClass: 'text-center',
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-48',
      dataClass: 'text-center',
    }

]
