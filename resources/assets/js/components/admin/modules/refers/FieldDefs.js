export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'w-4',
      dataClass: 'right aligned'
    },
    {
      name: 'id',
      title: 'شناسه',
      sortField: 'id',
      titleClass: 'text-center w-4',
      dataClass: 'text-center'
    },
    {
      name: 'from_fullname',
      title: 'از',
      sortField: 'from_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'to_fullname',
      title: 'به',
      sortField: 'to_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'description',
      title: 'توضیح',
      sortField: 'description',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'substring'
    },
    {
      name: 'created_at',
      title: 'تاریخ ارجاع',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    // {
    //   name: 'only_visible_for_receiver',
    //   title: 'وضعیت نمایش',
    //   sortField: 'only_visible_for_receiver',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'private'
    // },
    {
      name: '__component:refer-custom-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
