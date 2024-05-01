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
      name: 'priority',
      title: 'Priority',
      sortField: 'priority',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    // {
    //   name: 'price',
    //   title: 'Price',
    //   sortField: 'price',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'formatNumber'
    // },
    {
      name: 'type_title',
      title: 'Type',
      sortField: 'type',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'active',
      title: 'Active',
      sortField: 'active',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'checkmarkIcon'
    },
    {
      name: '__component:global-actions',
      title: 'Actions',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
