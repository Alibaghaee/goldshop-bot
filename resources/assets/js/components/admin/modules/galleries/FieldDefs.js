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
      name: 'category_item_name',
      title: 'گروه',
      sortField: 'category_item_id',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'locale_name',
      title: 'زبان',
      sortField: 'locale_id',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'items_count',
      title: 'تعداد تصاویر',
      sortField: 'items_count',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'url',
      title: 'پیوند',
      sortField: 'url',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
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
