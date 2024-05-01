<script>
export default {
  props: ['errors', 'options'],
  methods: {
    getOptions (name){
      if (_.has(this.options, name)) {
        return this.options[name];
      }
      return [];
    },
    getUrlSearchParam(key){
      var searchParams = new URLSearchParams(window.location.search);
      return searchParams.get(key);
    },
  }
}
</script>
