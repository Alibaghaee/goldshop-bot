export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'id',
      title: 'Id',
      sortField: 'id',
      titleClass: 'text-left',
      dataClass: 'text-left'
    },
    {
      name: 'item_title',
      title: 'Requested Service',
      sortField: 'item_title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    // {
    //   name: 'canceled',
    //   title: 'Canceled By Patient',
    //   sortField: 'canceled',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'cancelIcon'
    // },
    {
      name: 'status',
      title: 'Status',
      sortField: 'status',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'created_at',
      title: 'Date',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: '__component:request-item-custom-actions',
      title: 'Action',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }
]
