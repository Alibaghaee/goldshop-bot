export default {
  table: {
    tableWrapper: '',
    tableHeaderClass: 'fixed',
    tableBodyClass: 'vuetable-semantic-no-top fixed',
    tableClass: 'ui blue selectable unstackable celled table',
    loadingClass: 'loading',
    ascendingIcon: 'blue chevron up icon',
    descendingIcon: 'blue chevron down icon',
    ascendingClass: 'sorted-asc',
    descendingClass: 'sorted-desc',
    sortableIcon: 'grey sort icon',
    handleIcon: 'grey sidebar icon',
  },

  pagination: {
    wrapperClass: 'flex flex-wrap',
    activeClass: 'p-2 w-12 mx-1 bg-grey-light hover:bg-grey text-center cursor-pointer rounded bg-teal-light text-white',
    disabledClass: 'rahco-center p-2 w-12 mx-1 bg-grey-light hover:bg-grey text-center cursor-pointer rounded cursor-not-allowed text-blue bg-grey-lighter hover:bg-grey-lighter',
    pageClass: 'p-2 w-12 mx-1 bg-grey-light hover:bg-grey text-center cursor-pointer rounded',
    linkClass: 'rahco-center p-2 w-12 mx-1 bg-grey-light hover:bg-grey text-center cursor-pointer rounded',
    paginationClass: 'ui bottom attached segment grid',
    paginationInfoClass: 'my-6 text-blue',
    dropdownClass: 'text-blue',
    icons: {
      first: '',
      prev: '',
      next: '',
      last: '',
    }
  },

  paginationInfo: {
    infoClass: 'my-6 text-blue',
  }
}