export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'w-8',
      dataClass: 'left aligned'
    },
    {
      name: 'title',
      title: 'Title',
      sortField: 'title',
      titleClass: 'text-left',
      dataClass: 'text-left'
    },
    {
      name: 'active',
      title: 'Status',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'activeLabel'
    },
    {
      name: 'url',
      title: 'Link',
      sortField: 'address_slug',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'link'
    },
    {
      name: 'category_item_name',
      title: 'Group',
      sortField: 'category_item_id',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'locale_name',
      title: 'Language',
      sortField: 'locale_id',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: '__component:content-trash-custom-actions',
      title: 'Action',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
