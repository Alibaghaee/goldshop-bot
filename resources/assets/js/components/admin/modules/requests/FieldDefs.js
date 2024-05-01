export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'left aligned'
    },
    {
      name: 'id',
      title: 'Id',
      sortField: 'id',
      titleClass: 'text-left',
      dataClass: 'text-left'
    },
    {
      name: 'department_title',
      title: 'Department',
      sortField: 'department_title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'room_title',
      title: 'Room',
      sortField: 'room_title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'entity_title',
      title: 'Bed',
      sortField: 'entity_title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'user',
      title: 'User',
      sortField: 'user_id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'items_count',
      title: 'Requested Services Count',
      sortField: 'items_count',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: '__component:request-custom-actions-items',
      title: 'Requested Services',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: 'created_at',
      title: 'Date',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    // {
    //   name: 'payed',
    //   title: 'Payed',
    //   sortField: 'payed',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'checkmarkIcon'
    // },
    {
        name: '__component:request-restore-update',
        title: 'Restore Update Index',
        titleClass: 'text-center  ',
        dataClass: 'text-center',
    },
    {
      name: '__component:global-actions',
      title: 'Actions',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
