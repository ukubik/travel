<template lang="html">
  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <!-- To change the direction of the modal animation change .right class -->
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
    <div class="modal-dialog modal-side modal-top-right" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100 text-uppercase" id="myModalLabel">Авторизация</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body mx-3">
            <div class="md-form mb-5">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" id="form3" class="form-control validate" v-model="login">
                <label data-error="wrong" data-success="right" for="form3">Логин</label>
            </div>

            <div class="md-form mb-4">
                <i class="fa fa-user-secret prefix grey-text"></i>
                <input type="password" id="form2" class="form-control validate" v-model="password">
                <label data-error="wrong" data-success="right" for="form2">Пароль</label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> <span class="text-muted" v-model="remember"> Запомнить</span>
                </label>
            </div>

        </div>


        <div class="modal-footer">
          <div class="row">
            <div class="col">
              <a href="#" class="red-text">Забыли пароль?</a>
              <a href="#" class="red-text">Зарегистрироваться</a>
            </div>
            <div class="col d-flex justify-content-end">
              <!-- <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-sm btn-outline-elegant" v-on:click="signIn">Войти</button>
            </div>
          </div>

        </div>
      </div>
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
    }
  }
}
</script>

<style lang="css">
</style>
