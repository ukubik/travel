<template lang="html">

  <div class="modal fade right" id="auth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Errors -->
    <transition name="fade">
      <div class="alert alert-danger z-depth-3" v-if="this.errors.length > 0" v-show="showError" id="alert">
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
    <!-- /errors -->
    <!-- Messages -->
    <transition name="fade">
      <div class="alert alert-success z-depth-3" v-if="this.messages.length > 0" v-show="showMessage" id="alert">
        <button type="button" class="close" @click="hiddenMessage" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li>
                {{ messages }}
            </li>
        </ul>
      </div>
    </transition>
    <!-- /messages -->

    <div class="modal-dialog modal-side modal-top-right" role="document">
      <div class="modal-content" v-show="reset">
        <div class="modal-header bg-grey">
          <h4 class="modal-title w-100 text-uppercase white-text">Авторизация</h4>
          <button type="button" class="close red-text" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body mx-3">
          <div class="mb-4">
            <i class="fa fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="form3">Логин</label>
            <input type="text" id="form3" class="form-control form-control-sm validate" v-model="login">
          </div>

          <div class="mb-4">
            <i class="fa fa-user-secret prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="form2">Пароль</label>
            <input type="password" id="form2" class="form-control form-control-sm validate" v-model="password">
          </div>

          <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" v-model="remember"> <span class="text-muted"> Запомнить</span>
            </label>
          </div>
        </div>

        <div class="modal-footer">
          <div class="row">
            <div class="col">
              <a href="/password/reset" class="red-text" @click.prevent="reset = false">Забыли пароль?</a>
              <a href="#" class="red-text" data-toggle="modal" data-target="#registerModal" @click="closeAuthModal">Зарегистрироваться</a>
            </div>
            <div class="col d-flex justify-content-end">
              <!-- <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-sm btn-outline-elegant" v-on:click="signIn">Войти</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Восстановление пароля -->
      <div class="modal-content" v-show="!reset">
        <div class="modal-header bg-grey">
          <h4 class="modal-title w-100 text-uppercase white-text">Сброс пароля</h4>
          <button type="button" class="close red-text" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body mx-3">
          <div class="my-5">
            <i class="fa fa-envelope prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="form4">Ваш E-mail</label>
            <input type="email" id="form4" class="form-control form-control-sm validate" v-model="email">
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col">
              <a href="#" class="red-text" @click.prevent="reset = true">Авторизация</a>
              <a href="#" class="red-text" data-toggle="modal" data-target="#registerModal" @click="closeAuthModal">Зарегистрироваться</a>
            </div>
            <div class="col d-flex justify-content-end">
              <!-- <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-sm btn-outline-elegant" @click.prevent="resetPass" :disabled="send">Выслать</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /восстановление пароля -->
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      login: '',
      password: '',
      remember: false,
      showError: false,
      errors: [],
      email: '',
      reset: true,
      showMessage: true,
      messages: [],
      send: false
    }
  },

  methods: {
    //скрытие окна ошибки
    hiddenErr() {
      this.showError = false;
    },
    hiddenTimeOutErr() {
      setTimeout(() => {
        this.showError = false;
      }, 5000);
    },
    //скрытие окна уведомления
    hiddenMessage() {
      this.showMessage = false;
    },
    hiddenTimeOutMess() {
      setTimeout(() => {
        this.showMessage = false;
        $('#auth').modal('hide');
      }, 5000);
    },

    signIn() {
      axios.post('/login', {
        login: this.login,
        password: this.password,
        remember: this.remember
      }).then(response => {
        $('#auth').modal('hide');
        location.reload();
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },

    resetPass() {
      this.send = true;
      axios.post('/password/email', {
        email: this.email
      }).then(response => {
        if(response.data.message.length > 0) {
          this.email = '';
          this.showMessage = true;
          this.messages = response.data.message;
          this.hiddenTimeOutMess();
        }
      }).catch(error => {
        this.send = false;
        if(error.response.data.message.length > 0 && error.response.data.errors === undefined) {
          this.showError = true;
          this.errors = [error.response.data.message];
          this.hiddenTimeOutErr();
        } else {
          this.showError = true;
          this.errors = _.flatten(_.toArray(error.response.data.errors));
          this.hiddenTimeOutErr();
        }
      });
    },

    closeAuthModal() {
      $('#auth').modal('hide');
    }
  }
}
</script>

<style lang="css">
</style>
