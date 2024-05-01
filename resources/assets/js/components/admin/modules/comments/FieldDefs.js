export default [
    {
        name: '__sequence',
        title: '#',
        titleClass: '',
        dataClass: 'right aligned'
    },
    {
        name: 'shortRelatedTitle',
        title: 'عنوان',
        sortField: 'shortRelatedTitle',
        titleClass: 'text-center',
        dataClass: 'text-center'
    }, {
        name: 'short_description',
        title: 'متن',
        sortField: 'short_description',
        titleClass: 'text-center',
        dataClass: 'text-center'
    }, {
        name: 'writer',
        title: 'ثبت کننده',
        sortField: 'writer',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    {
        name: 'status_fa',
        title: 'وضعیت',
        sortField: 'status_fa',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },

    {
        name: 'pendingCommentsCount',
        title: 'ریپلای های درانتظار',
        sortField: 'pendingCommentsCount',
        titleClass: 'text-right',
        dataClass: 'text-right'
    },
    {
        name: 'publishedCommentsCount',
        title: 'ریپلای های منتشرشده',
        sortField: 'publishedCommentsCount',
        titleClass: 'text-right',
        dataClass: 'text-right'
    },
    {
        name: 'commentUrl',
        title: 'ریپلای ها',
        sortField: 'commentUrl',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'link'
    },
    {
        name: 'articleUrl',
        title: 'لینک مطلب',
        sortField: 'articleUrl',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'link'
    },
    {
        name: 'created_at_fa',
        title: 'تاریخ',
        sortField: 'created_at_fa',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    {
        name: '__component:global-actions',
        title: 'عملیات',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    }

]
