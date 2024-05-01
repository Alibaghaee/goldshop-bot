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
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'database',
      title: 'از طریق پنل کاربری',
      sortField: 'database',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'boolean'
    },
    {
      name: 'sms',
      title: 'از طریق پیامک',
      sortField: 'sms',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'boolean'
    },
    // {
    //   name: '__component:notify-custom-actions',
    //   title: 'عملیات',
    //   titleClass: 'text-center w-1/5',
    //   dataClass: 'text-center',
    // }

]
