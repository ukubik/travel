<template lang="html">

  <div class="container white-text">

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

    <div class="row">
      <div class="col text-shadow">
        <h5>Вы можете оставить свой комметарий</h5>
        <small>только для зарегистрированных пользователей.</small>
        <p>Ваш комментарий <small class="red-text"> (E-mail опубликован не будет!)</small> </p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-7">
        <textarea class="form-control form-control-sm" rows="3" v-model="comment"></textarea>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-md-7 d-flex justify-content-end">
        <button class="btn btn-outline-white btn-sm waves-effect" role="button" @click="storeComment"> отправить
          <i class="fa fa-angle-double-right fa-15x ml-2" aria-hidden="true"></i>
        </button>
      </div>
    </div>

  </div>

</template>

<script>
export default {
  props: [
    'article_id'
  ],

  data() {
    return {
      showError: false,
      errors: [],
      showMessage: true,
      messages: [],
      comment: ''
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
      }, 5000);
    },

    storeComment() {
      axios.post('/comment/create/' + this.article_id, {
        content: this.comment
      }).then(response => {
        this.showMessage = true;
        this.comment = '';
        this.messages = response.data.message;
        this.hiddenTimeOutMess();
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

.btn-outline-white {
  /* z-index: 9999; */
  border: 2px solid #ffffff !important;
  border-radius: 25px;
  background-color: rgba(255,255,255,.2) !important;
  color: #ffffff !important;
}

.btn-outline-white:hover {
  background-color: rgba(255,255,255,.7) !important;
  color: rgb(233, 30, 99) !important;
  border: 2px solid rgb(233, 30, 99) !important;
}
</style>
