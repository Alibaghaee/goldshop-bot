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
      name: 'removable',
      title: 'Removable',
      sortField: 'removable',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'lockLabel'
    },
    // {
    //   name: 'locale_name',
    //   title: 'Language',
    //   sortField: 'locale_id',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    // },
    {
      name: '__component:setting-trash-custom-actions',
      title: 'Actions',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
