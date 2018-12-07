<template lang="html">

  <div>

    <!-- Destroy errors -->
    <transition name="fade">
      <div class="alert alert-danger z-depth-2" v-if="this.errors.length > 0" v-show="showErr" id="alert">
        <button type="button" class="close" @click="hiddenErr" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li v-for="error in this.errors">
                {{ error }}
            </li>
        </ul>
      </div>
    </transition>
    <!-- /Destroy errors -->

    <!-- Update message -->
    <transition name="fade">
      <div class="alert alert-success z-depth-2" v-show="showMess" id="alert">
        <button type="button" class="close" @click="hiddenMess" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li v-for="message in this.messages">
                {{ message }}
            </li>
        </ul>
      </div>
    </transition>
    <!-- /Update message -->

    <form class="form-horizontal">

        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Имя <span class="red-text">*</span></label>

            <div class="col">
                <input id="name" type="text" class="form-control" v-model="name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">Ваш E-Mail адрес <span class="red-text">*</span></label>

            <div class="col">
                <input id="email" type="email" class="form-control" v-model="email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-md-4 control-label">Ваше сообщение <span class="red-text">*</span></label>

            <div class="col">
                <textarea id="message" v-model="message" class="form-control" rows="8" cols="80" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col text-center">
              <vue-recaptcha @verify="onVerify"
                             @expired="onExpired"
                             :sitekey="captcha_key">
              </vue-recaptcha>
            </div>
        </div>
    </form>
  </div>

</template>

<script>
import VueRecaptcha from 'vue-recaptcha';
export default {
  components: { VueRecaptcha },
  props: [
    'captcha_key',
    'captcha_secret'
  ],

  data() {
    return {
      messages: [],
      showMess: false,
      showErr: false,
      errors: [],
      name: '',
      email: '',
      message: '',
    }
  },

  mounted() {

  },

  methods: {
    clearData() {
      this.name = '';
      this.email = '';
      this.message = '';
    },

    sendMessage() {
      axios.post('/sendmessage', {
        name: this.name,
        email: this.email,
        message: this.message,
      }).then(response => {
        this.clearData();
        this.showMessages(response);
      }).catch(error => {
        this.showErrors(error);
      });
    },

    onVerify: function (response) {
      // console.log('Verify: ' + response);
      this.sendMessage();
    },

    onExpired: function () {
      console.log('Expired')
    },

    resetRecaptcha () {
      this.$refs.recaptcha.reset() // Direct call reset method
    },

    //скрытие окна ошибки
    showMessages(response) {
      if (typeof response.data === 'object') {
        this.messages = _.flatten(_.toArray(response.data.messages));
        this.showMess = true;
        this.hiddenTimeOutMess()
        if(response.data.messages === undefined) {
          this.messages = [response.data.messages];
        }
      }
    },
    showErrors(error) {
      if (typeof error.response.data === 'object') {
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.showErr = true;
        this.hiddenTimeOutErr()
        if(error.response.data.errors === undefined) {
          this.errors = [error.response.data.message];
        }
      }
    },
    hiddenErr() {
      this.showErr = false;
    },

    hiddenMess() {
      this.showMess = false;
    },

    hiddenTimeOutErr() {
      setTimeout(() => {
        this.showErr = false;
      }, 5000);
    },

    hiddenTimeOutMess() {
      setTimeout(() => {
        this.showMess = false;
      }, 5000);
    },
  }
}
</script>

<style lang="css">
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
#alert {
  position: fixed;
  width: auto;
  top: 105px;
  right: 10px;
  z-index: 9999;
}
</style>
