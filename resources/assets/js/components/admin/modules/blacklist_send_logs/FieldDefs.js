export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'note',
      title: 'متن پیام',
      sortField: 'note',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'long_substring'
    },
    {
      name: 'admin_fullname',
      title: 'ارسال کننده',
      sortField: 'admin_fullname',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'send_type',
      title: 'نحوه ارسال',
      sortField: 'send_type',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'total_note_parts',
      title: 'تعداد صفحات',
      sortField: 'total_note_parts',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'formatNumber'
    },
    {
      name: 'receivers_count',
      title: 'تعداد گیرندگان',
      sortField: 'receivers_count',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'formatNumber'
    },
    {
      name: 'user_total_price',
      title: 'هزینه ارسال کاربر',
      sortField: 'user_total_price',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'formatNumber'
    },
    {
      name: 'created_at_fa',
      title: 'تاریخ ارسال',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: '__component:blacklist-send-log-custom-actions',
      title: 'دریافت خروجی',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },
]
