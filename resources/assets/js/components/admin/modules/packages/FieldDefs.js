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
      name: 'price',
      title: 'مبلغ کل',
      sortField: 'price',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'number_format',
    },
    {
      name: 'allow_installment',
      title: 'قسطی',
      sortField: 'allow_installment',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'boolean',
    },
    {
      name: 'pre_payment',
      title: 'مبلغ پیش پرداخت',
      sortField: 'pre_payment',
      titleClass: 'text-center',
      dataClass: 'text-center',
      callback: 'number_format',
    },
    {
      name: '__component:global-actions',
      title: 'عملیات',
      titleClass: 'text-center w-1/5',
      dataClass: 'text-center',
    }

]
