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
      name: 'department',
      title: 'Department',
      sortField: 'department',
      titleClass: 'text-left',
      dataClass: 'text-left'
    },
    {
      name: 'room',
      title: 'Room',
      sortField: 'room',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'title',
      title: 'Title',
      sortField: 'title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'description',
      title: 'Description',
      sortField: 'description',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'truncateString'
    },
    // {
    //   name: 'payable',
    //   title: 'Payable',
    //   sortField: 'payable',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'checkmarkIcon'
    // },
    // {
    //   name: 'auth_type_name',
    //   title: 'Auth Type',
    //   sortField: 'auth_type',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
      name: 'active',
      title: 'Active',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'checkmarkIcon'
    },
    {
      name: 'items_count',
      title: 'Services Count',
      sortField: 'items_count',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
        name: '__component:entity-trash-custom-actions',
        title: 'Actions',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    },

]
