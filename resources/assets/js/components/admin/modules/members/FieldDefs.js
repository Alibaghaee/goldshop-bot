export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'name',
      title: 'نام',
      sortField: 'name',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'family',
      title: 'نام خانوادگی',
      sortField: 'family',
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
      name: 'birth_date_fa',
      title: 'تاریخ تولد',
      sortField: 'birth_date',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: 'province_title',
      title: 'استان',
      sortField: 'province_title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'city_title',
      title: 'شهر',
      sortField: 'city_title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'complete',
      title: 'تکمیل',
      sortField: 'complete',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'boolean'
    },
    {
      name: 'blacklist',
      title: 'حذف شده',
      sortField: 'blacklist',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'boolean'
    },
    {
      name: 'created_at_fa',
      title: 'تاریخ ثبت',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    // {
    //   name: '__component:global-actions',
    //   title: 'عملیات',
    //   titleClass: 'text-center w-1/5',
    //   dataClass: 'text-center',
    // }

]
