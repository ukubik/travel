<template lang="html">

  <!-- Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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

      <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
      <div class="modal-dialog modal-dialog-centered" role="document">


          <div class="modal-content">
              <div class="modal-header bg-grey">
                  <h5 class="modal-title text-uppercase white-text" id="registerModal">регистрация</h5>
                  <button type="button" class="close red-text" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body mx-3">
                <div class="mb-1">
                  <i class="fa fa-user prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form5">Логин
                    <span class="red-text star">*</span>
                    <!-- <small class="text-muted">(латиница, цифры, нижнеее подчеркивание)</small> -->
                  </label>
                  <input type="text" id="form5" class="form-control form-control-sm validate" v-model="login">
                </div>

                <div class="mb-1">
                  <i class="fa fa-envelope prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form6">E-mail <span class="red-text star">*</span></label>
                  <input type="email" id="form6" class="form-control form-control-sm validate" v-model="email">
                </div>

                <div class="mb-1">
                  <i class="fa fa-user-secret prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form7">Пароль <span class="red-text star">*</span></label>
                  <input type="password" id="form7" class="form-control form-control-sm validate" v-model="password">
                </div>

                <div class="mb-1">
                  <i class="fa fa-user-secret prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form8">Повторите пароль <span class="red-text star">*</span></label>
                  <input type="password" id="form8" class="form-control form-control-sm validate" v-model="password_confirmation">
                </div>

              </div>

              <div class="modal-footer">
                  <div class="row">
                    <div class="col">
                      <div class="checkbox">
                        <label>
                            <input type="checkbox" name="agree" v-model="agree"> <small class="text-muted">
                              Согласен с условиями <a href="/rules" class="red-text">пользовательского соглашения</a>
                             </small>
                        </label>
                      </div>
                    </div>
                    <div class="col d-flex justify-content-end">
                      <button type="button" class="btn btn-sm btn-outline-elegant" :disabled="!agree" @click.prevent="register">зарегистрироваться</button>
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
      email: '',
      password: '',
      password_confirmation: '',
      agree: false,
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
    register() {
      axios.post('/register', {
        login: this.login,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      }).then(response => {
        this.login = '';
        this.email = '';
        this.password = '';
        this.password_confirmation = '';
        this.agree = false;
        $('#registerModal').modal('hide');
        location.reload();
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },
  }
}
</script>

<style lang="css">

</style>
