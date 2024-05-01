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
    },
    {
        name: 'description',
        title: 'Description',
        sortField: 'description',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'truncateString'
    },
    {
        name: 'active',
        title: 'Active',
        sortField: 'active',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'checkmarkIcon'
    },
    {
        name: '__component:entity-restore-update-action',
        title: 'Restore Update',
        titleClass: 'text-center w-1/5',
        dataClass: 'text-center',
    }

]
