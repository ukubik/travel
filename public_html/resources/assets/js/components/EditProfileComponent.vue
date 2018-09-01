<template lang="html">
  <!-- Modal -->
  <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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
                  <h5 class="modal-title text-uppercase white-text" id="editProfile">Редактирование профиля</h5>
                  <button type="button" class="close red-text" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body mx-3">
                <div class="mb-1 text-center">
                  <label for="file-upload" data-toggle="tooltip" data-placement="bottom" title="Изменить аватар (не более 200 Кб)">
                    <img :src="'/public/storage/' + user.avatar_path" class="rounded-circle img-fluid cursor-hand" alt="Avatar" style="max-height:100px">
                  </label>
                  <input id="file-upload" type="file" ref="file" accept="image/*" v-on:change="handleFilesUpload()">
                </div>

                <div class="mb-1">
                  <i class="fa fa-user prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form9">Логин
                    <span class="red-text star">*</span>
                    <!-- <small class="text-muted">(латиница, цифры, нижнеее подчеркивание)</small> -->
                  </label>
                  <input type="text" id="form9" class="form-control form-control-sm validate" v-model="user.login">
                </div>

                <div class="mb-1">
                  <i class="fa fa-envelope prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form10">E-mail <span class="red-text star">*</span></label>
                  <input type="email" id="form10" class="form-control form-control-sm validate" v-model="user.email">
                </div>

                <div class="mb-1">
                  <i class="fa fa-user-secret prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form11">Пароль <span class="red-text star">*</span></label>
                  <input type="password" id="form11" class="form-control form-control-sm validate" v-model="password">
                </div>

                <div class="mb-1">
                  <i class="fa fa-user-secret prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="form12">Повторите пароль <span class="red-text star">*</span></label>
                  <input type="password" id="form12" class="form-control form-control-sm validate" v-model="password_confirmation">
                </div>

                <div class="mb-1 cursor-hand">
                  <span class="red-text text-uppercase" v-if="user.subscription === 'Не подписан'" @click="subscrybe('Подписан')"> <ins>оформить подписку на новые статьи</ins> </span>
                  <span class="blue-text text-uppercase" v-if="user.subscription === 'Подписан'" @click="subscrybe('Не подписан')"> <ins>вы подписаны</ins> </span>
                </div>

              </div>

              <div class="modal-footer">
                  <div class="row">
                    <div class="col d-flex justify-content-end">
                      <button type="button" class="btn btn-sm btn-outline-elegant" :disabled="agree" @click.prevent="updateProfile">сохранить</button>
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
      password: '',
      password_confirmation: '',
      agree: false,
      showError: false,
      errors: [],
      user: {
        login: '',
        email: '',
      },
      file: '',
    }
  },

  mounted() {
    this.getUser();
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

    getUser() {
      axios.get('/user/get-user').then(response => {
        this.user = response.data;
      });
    },

    handleFilesUpload(){
      this.file = this.$refs.file.files[0];
      console.log(this.file);
    },

    updateProfile() {
      let formData = new FormData();
      formData.append('avatar_path', this.file);
      formData.append('login', this.user.login);
      formData.append('email', this.user.email);
      formData.append('password', this.password);
      formData.append('password_confirmation', this.password_confirmation);
      axios.post('/user/profile/' + this.user.id,
        formData, {
          headers: {'Content-Type': 'multipart/form-data'}
      }).then(response => {
        this.user = response.data;
        this.password = '';
        this.password_confirmation = '';
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },

    subscrybe(text) {
      axios.put('/user/subscrybe/' + this.user.id, {
        subscription: text
      }).then(response => {
        this.getUser();
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

.cursor-hand:hover {
  cursor: pointer;
}

input[type="file"] {
  display: none;
}

label {
  margin-bottom: 0;
}

</style>
