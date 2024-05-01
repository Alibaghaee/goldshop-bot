export default [
    {
        name: '__checkbox',
        titleClass: 'left aligned',
        dataClass: 'left aligned'
    },
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
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
      name: 'key',
      title: 'Key',
      sortField: 'key',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'active',
      title: 'Active',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'checkmarkIcon',
    },
    {
        name: '__component:language-trash-custom-actions',
        title: 'Actions',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    },

]
