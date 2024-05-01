export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'w-8',
      dataClass: 'right aligned'
    },
    // {
    //   name: '__handle',   // <----
    //   title: '*********',
    //   dataClass: 'h-6 w-6 bg-grey'
    // },
    // {
    //   name: '__checkbox',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
      name: 'name',
      title: 'نام',
      sortField: 'name',
      titleClass: 'text-right',
      dataClass: 'text-right'
    }, 
    {
      name: 'email',
      title: 'ایمیل',
      sortField: 'email',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'mobile',
      title: 'موبایل',
      sortField: 'mobile',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'username',
      title: 'نام کاربری',
      sortField: 'username',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    // {
    //   name: 'birthdate',
    //   title: 'تاریخ تولد',
    //   sortField: 'birthdate',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'formatDate|DD-MM-YYYY'
    // },
    // {
    //   name: 'gender',
    //   title: 'عنوان',
    //   sortField: 'gender',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    //   callback: 'genderLabel'
    // },
    // {
    //   name: '__slot:actions',
    //   title: 'عملیات',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center'
    // },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center',
      dataClass: 'text-center',
    }
]
