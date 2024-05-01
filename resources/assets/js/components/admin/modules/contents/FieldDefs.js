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
      name: 'active',
      title: 'وضعیت',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'activeLabel'
    },
    {
      name: 'url',
      title: 'پیوند',
      sortField: 'address_slug',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: 'category_item_name',
      title: 'گروه',
      sortField: 'category_item_id',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    // {
    //   name: 'locale_name',
    //   title: 'زبان',
    //   sortField: 'locale_id',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    // },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
