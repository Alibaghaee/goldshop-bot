<script>
    export default {
        created(){
          // this.form_data[this.name] = this.value
          this.$set(this.form_data, this.name, this.value)
        },
        methods: {
          doFilter () {
            this.$events.fire('filter-set', this.form_data)
            window.events.$emit('filter-set-for-report', this.form_data)
          },
        }
    }
</script>