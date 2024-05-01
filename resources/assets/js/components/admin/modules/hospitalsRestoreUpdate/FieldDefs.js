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
        titleClass: 'text-left',
        dataClass: 'text-left'
    },
    {
        name: 'domain',
        title: 'Domain',
        sortField: 'domain',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },
    {
        name: 'active',
        title: 'Active',
        sortField: 'active',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'activeLabel'
    },
    {
        name: 'expire_date',
        title: 'Expire Date',
        sortField: 'expire_date',
        titleClass: 'text-center',
        dataClass: 'text-center'
    }, {
        name: 'access_code',
        title: 'Code',
        sortField: 'access_code',
        titleClass: 'text-center',
        dataClass: 'text-center'
    },

    {
        name: '__component:plato-restore-update-action',
        title: 'Restore Update',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    }

]
