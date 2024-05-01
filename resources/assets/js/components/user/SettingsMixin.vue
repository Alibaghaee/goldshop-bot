<script>
import ClickOutside from 'vue-click-outside'

export default {
  props: ['languages', 'user'],
  data() {
    return {
      active_menu: 'Account',
      notification: this.user.settings ? this.user.settings.notification : '',
      voice: this.user.settings ? this.user.settings.voice : '',
      active_lang: {'id': this.user.settings ? this.user.settings.language : this.defaultLanguage()},
      account_edit: false,
    }
  },

  watch: {
    voice: function () {
      this.updateSettings()
    },
    notification: function () {
      this.updateSettings()
    },
    active_lang: function () {
      this.updateSettings(true)
    },
  },

  methods: {
    getHospitalList(data) {

      axios.get('user/hospital/getLink')
          .then(function (response) {


            window.location.href = response.data.data.redirect
          })
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },
    setActiveItem(item) {
      this.active_menu = item
    },

    setLanguage(language) {
      this.active_lang = language
    },

    showDialog(data) {
      this.$modal.show('confirm')
    },

    updateSettings(refresh = false) {
      let endpoint = genrateAddress('user/settings')
      let data = {
        'notification': this.notification,
        'voice': this.voice,
        'language': this.active_lang.id,
      }

      axios.put(endpoint, data)
          .then(function (response) {
            if (refresh) {
              window.location.href = genrateAddress('user/settings', this.active_lang.key)
            }
            flash('Done!')
          }.bind(this))
          .catch(function (error) {
            flash('Error', 'error')
          });
    },

    updateUser() {
      // let endpoint = genrateAddress('user')
      // let data = {
      //   'name' : this.user.name,
      //   'family' : this.user.family,
      //   'username' : this.user.username,
      // }

      // axios.put(endpoint, data)
      // .then(function (response){
      //   this.account_edit = false
      //   // flash('Updated Successfully')
      // }.bind(this))
      // .catch(function(error){
      //   flash('Error', 'error')
      // });
    },

    logout() {
      this.$modal.hide('confirm')
      axios.post('/logout')
          .then(function (response) {
            window.location.href = response.data.redirect
          })
          .catch(function (error) {
            flash('Error', 'error')
          });
    },

    defaultLanguage() {
      let index = _.findIndex(this.languages, {'lower_case_key': App.locale});
      return this.languages[index].id
    },

  },
}
</script>