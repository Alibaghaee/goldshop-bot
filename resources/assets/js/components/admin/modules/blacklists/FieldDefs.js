export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'message',
      title: 'متن',
      sortField: 'message',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'long_substring'
    },
    {
      name: 'sender_number',
      title: 'ارسال کننده',
      sortField: 'sender_number',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'status',
      title: 'وضعیت',
      sortField: 'status',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'blacklist_status'
    },
    {
      name: 'user_fullname',
      title: 'کاربر',
      sortField: 'user_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'substring'
    },
    {
      name: 'date',
      title: 'تاریخ ارسال',
      sortField: 'date',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: 'blacklist_type',
      title: 'نوع ارسال',
      sortField: 'blacklist_type',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'blacklist_send_type'
    },
    {
      name: 'sendable_count',
      title: 'تعداد قابل ارسال',
      sortField: 'sendable_count',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'formatNumber'
    },
    {
      name: 'lack_of_cash',
      title: 'کمبود شارژ',
      sortField: 'lack_of_cash',
      titleClass: 'text-center',
      dataClass: 'text-center text-pink',
      callback: 'formatNumber'
    },
    {
      name: 'deliver_status',
      title: 'وضعیت دلیور',
      sortField: 'deliver_status',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'deliver_status'
    },
    {
      name: '__component:blacklist-custom-actions',
      title: 'عملیات',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
    // {
    //   name: '__component:global-actions',
    //   title: 'عملیات',
    //   titleClass: 'text-center',
    //   dataClass: 'text-center',
    // }

]
