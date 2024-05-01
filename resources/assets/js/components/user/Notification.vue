<template>
      <div>
        <audio ref="blank_voice" src="/sound/blank.mp3" preload="auto" autoplay loop></audio>
        <audio ref="patient_notification_1" src="/sound/patient_notification_1.mp3" preload="auto"></audio>
      </div>
</template>

<script>

  export default {

        mounted(){
          document.addEventListener('click', this.playBlankVoice)
        },

        created(){
          this.patientRequestAcceptEvent()
        },

        methods: {
            openAudioChannelIos(){
              this.$refs.patient_notification_1.play()
              this.$refs.patient_notification_1.pause()
            },

            playNotification(){
              if (window.App.settings.voice == true) {
                  this.$refs.patient_notification_1.play()
              }
            },

            playBlankVoice(){
              let audio = this.$refs.blank_voice;
              audio.play();

              this.openAudioChannelIos()
            },

            patientRequestAcceptEvent(){
              var patient_channel_one = Echo.private(`request-accept.${window.App.user_id}`)
              patient_channel_one.listen('.patient-request-accept-event', (e) => {
                if (e.request_item.status_id == 1) {
                  flash('Patient Reqeust Accept Message');
                  this.playNotification()
                }
              });
            }
        }
  }
</script>