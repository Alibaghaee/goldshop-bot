export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'w-8',
      dataClass: 'left aligned'
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
      title: 'Name',
      sortField: 'name',
      titleClass: 'text-left',
      dataClass: 'text-left'
    }, 
    {
      name: 'email',
      title: 'Email',
      sortField: 'email',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'mobile',
      title: 'Mobile',
      sortField: 'mobile',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'username',
      title: 'Username',
      sortField: 'username',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'entities_count',
      title: 'Assigned Bed(s) Count',
      sortField: 'entities_count',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'present',
      title: 'Present',
      sortField: 'present',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'checkmarkIcon'
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
        name: '__component:admin-trash-custom-actions',
        title: 'Actions',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    },

]
