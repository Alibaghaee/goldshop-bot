<script>
export default {
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number
    },
    icons: {
      type: Object,
      default () {
        return {
          edit: `
          <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 451.44500732421875 451.44500732421875"><path d="M131 411.018l-90.569-90.569L290.78 70.101l90.57 90.569zm308.723-351.18l-48.115-48.114C379.885 0 360.05.828 347.304 13.574l-45.202 45.203 90.569 90.568 45.202-45.202c12.743-12.746 13.572-32.582 1.85-44.305zM32.021 334.697L0 451.445l116.737-32.021z"/></svg>
          `,
          delete: `
          <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1100 1300" ><path d="M400 0h300q41 0 70.5 29.5T800 100v100h275q10 0 17.5 7.5t7.5 17.5v75H0v-75q0-10 7.5-17.5T25 200h275V100q0-41 29.5-70.5T400 0zm0 100v100h300V100H400zm600 300v800q0 41-29.5 70.5T900 1300H200q-41 0-70.5-29.5T100 1200V400h900zM200 500v700h100V500H200zm200 0v700h100V500H400zm200 0v700h100V500H600zm200 0v700h100V500H800z"></path></svg>
          `,
        }
      }
    }
  },

  methods: {
    itemAction (action) {
      if (action == 'delete') {
        deleteModal({ 
          endpoint: this.rowData.delete_uri,
          title: this.rowData.title
        })
      }
    }
  }
}
</script>
