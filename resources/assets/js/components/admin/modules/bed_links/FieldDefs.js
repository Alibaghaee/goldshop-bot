export default [
    {
        name: '__sequence',
        title: '#',
        titleClass: '',
        dataClass: 'right aligned'
    },
    {
        name: 'title',
        title: 'Title',
        sortField: 'title',
        titleClass: 'text-center',
        dataClass: 'text-center'
    }, {
        name: 'link',
        title: 'Link',
        sortField: 'link',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'link'

    },{
        name: 'active',
        title: 'Active',
        sortField: 'active',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'activeLabel'
    },
    {
        name: '__component:global-actions',
        title: 'عملیات',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    }

]
