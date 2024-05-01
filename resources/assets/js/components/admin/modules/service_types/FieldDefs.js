export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'w-16',
      dataClass: 'right aligned'
    },
    {
      name: 'title',
      title: 'Title',
      sortField: 'title',
      titleClass: 'text-left',
      dataClass: 'text-left'
    },
    {
      name: 'global',
      title: 'Global',
      sortField: 'global',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'checkmarkIcon'
    },
    {
      name: 'color',
      title: 'Color',
      sortField: 'color',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'color'
    },
    {
      name: 'services_count',
      title: 'Services Count',
      sortField: 'services_count',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    {
      name: '__component:global-actions',
      title: 'Actions',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
