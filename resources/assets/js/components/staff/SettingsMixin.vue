<script>
import ClickOutside from 'vue-click-outside'

export default {
  props: ['languages', 'user', 'types'],

  data() {
    return {
      active_menu: 'Account',
      notification: this.user.settings ? this.user.settings.notification : '',
      voice: this.user.settings ? this.user.settings.voice : '',
      vibration: this.user.settings ? this.user.settings.vibration : '',
      active_lang: {'id': this.user.settings ? this.user.settings.language : this.defaultLanguage()},
      account_edit: false,
      active_types: this.user.settings ? (this.user.settings.active_types ? this.user.settings.active_types : []) : [],
      pause: this.user.settings ? this.user.settings.pause : '',
    }
  },

  watch: {
    voice: function () {
      this.updateSettings()
    },
    vibration: function () {
      this.updateSettings()
    },
    notification: function () {
      this.updateSettings()
    },
    active_lang: function () {
      this.updateSettings(true)
    },
    active_types: {
      handler(val) {
        this.updateSettings()
      },
      deep: true
    },
    pause: function () {
      this.updateSettings()
    },
  },



  methods: {
    setActiveItem(item) {
      this.active_menu = item
    },

    setLanguage(language) {
      this.active_lang = language
    },

    showLogoutDialog(data) {
      // this.$modal.show('logout_modal')
      axios.post('/logout')
          .then(function (response) {
            window.location.href = response.data.redirect
          })
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },
    getHospitalList(data) {

      axios.get('staff/hospital/getLink')
          .then(function (response) {


            window.location.href = response.data.data.redirect
          })
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },

    updateSettings(refresh = false) {
      let endpoint = genrateAddress('settings')
      let data = {
        'notification': this.notification,
        'voice': this.voice,
        'vibration': this.vibration,
        'language': this.active_lang.id,
        'active_types': this.active_types,
        'pause': this.pause,
      }

      axios.put(endpoint, data)
          .then(function (response) {
            if (response.data.message) {
              flash(response.data.message)
            }

            // refresh websocket data
            window.Echo.leave(`hospital.${window.App.domain_id}`)
            window.Echo.join(`hospital.${window.App.domain_id}`)

            if (this.pause) {
              window.Echo.leave(`hospital.${window.App.domain_id}`)
            } else {
              window.Echo.join(`hospital.${window.App.domain_id}`)
            }

            if (refresh) {
              window.location.href = genrateAddress('settings', this.active_lang.key)
            }
            // flash('Done!')
          }.bind(this))
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },

    updateUser() {
      let endpoint = genrateAddress('user')
      let data = {
        'name': this.user.name,
        'family': this.user.family,
        'username': this.user.username,
      }

      axios.put(endpoint, data)
          .then(function (response) {
            this.account_edit = false
            // flash('Updated Successfully')
          }.bind(this))
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },

    logout() {
      this.$modal.hide('logout_modal')
      axios.post('/logout')
          .then(function (response) {
            window.location.href = response.data.redirect
          })
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },

    defaultLanguage() {
      let index = _.findIndex(this.languages, {'lower_case_key': App.locale});
      return this.languages[index].id
    },

    activeTypesCount() {
      let count = _.countBy(Object.values(this.active_types), (value) => {
        return value == true;
      });

      return count.true
    },

    isSingleTypeSelection() {
      return this.activeTypesCount() == 1
    },

    checkTypeInputDisable(type) {
      return this.active_types[type.id] == true && this.isSingleTypeSelection()
    },

    checkSingleTypeNotification(type) {
      if (this.checkTypeInputDisable(type)) {
        flash('At Least One Type Must Be Selected')
      }
    }

  },

  computed: {
    active_types_string() {
      let result = [];

      this.types.forEach(function (type, index) {
        if (this.active_types[type.id] == true) {
          result.push(type.name);
        }
      }.bind(this));

      return result.join(", ")
    }
  }
}
</script>