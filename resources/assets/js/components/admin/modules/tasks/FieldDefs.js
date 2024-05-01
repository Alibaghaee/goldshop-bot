export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: 'text-sm ',
      dataClass: 'text-sm right aligned'
    },
    {
      name: 'id',
      title: 'شناسه',
      sortField: 'id',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center'
    },
    {
      name: 'creator_fullname',
      title: 'ایجاد کننده',
      sortField: 'creator_fullname',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center'
    },
    {
      name: 'receiver_fullname',
      title: 'دریافت کننده',
      sortField: 'receiver_fullname',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center'
    },
    {
      name: 'description',
      title: 'وظیفه',
      sortField: 'description',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center',
      callback: 'substring'
    },
    {
      name: 'start_date',
      title: 'تاریخ',
      sortField: 'start_date',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center ltr'
    },
    {
      name: 'deadline',
      title: 'مهلت',
      sortField: 'deadline',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center ltr'
    },
    {
      name: 'report_status',
      title: 'وضعیت گزارش',
      sortField: 'report_status',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center',
      callback: 'reportStatus'
    },
    {
      name: 'reported_at',
      title: 'زمان گزارش',
      sortField: 'reported_at',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center ltr'
    },
    {
      name: 'status',
      title: 'وضعیت انجام کار',
      sortField: 'status',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center',
      callback: 'taskStatus'
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-sm text-center',
      dataClass: 'text-sm text-center',
    }

]
