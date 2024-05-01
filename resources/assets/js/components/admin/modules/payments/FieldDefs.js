export default [
    {
      name: '__sequence',
      title: '#',
      titleClass: '',
      dataClass: 'right aligned'
    },
    {
      name: 'id',
      title: 'شناسه',
      sortField: 'id',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'title',
      title: 'عنوان',
      sortField: 'title',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'user_fullname',
      title: 'پرداخت کننده',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'price',
      title: 'مبلغ (ریال)',
      sortField: 'price',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'formatNumber'
    },
    {
      name: 'payed',
      title: 'وضعیت تراکنش',
      sortField: 'payed',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'payed'
    },
    {
      name: 'card_number',
      title: 'شماره کارت',
      sortField: 'card_number',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: 'tracking_code',
      title: 'کد پیگیری',
      sortField: 'tracking_code',
      titleClass: 'text-center',
      dataClass: 'text-center'
    },
    {
      name: 'created_at_fa',
      title: 'تاریخ تراکنش',
      sortField: 'created_at',
      titleClass: 'text-center',
      dataClass: 'text-center ltr'
    },
    {
      name: '__component:payment-custom-actions',
      title: 'عملیات',
      titleClass: 'text-center',
      dataClass: 'text-center',
    },

]
