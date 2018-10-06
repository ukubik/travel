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

    <div class="row mb-2">
      <div class="col text-shadow">
        <h5>Вы можете оставить свой комметарий</h5>
        <!-- <small>только для зарегистрированных пользователей.</small> -->
        <small class="red-text"> (E-mail опубликован не будет!)</small>
      </div>
    </div>

    <form class="border border-green p-2 m-2 rounded">
      <div class="form-group">
        <div class="col-md-5">
          <input type="text" class="form-control form-control-sm z-depth-1" placeholder="Ваше имя" v-model="name">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-5">
          <input type="email" class="form-control form-control-sm z-depth-1" placeholder="Ваш Email (не обязятельно)" v-model="email">
        </div>
      </div>

      <div class="row">
        <div class="col-md-7">
          <em v-bind:class="{ 'blue-text': result_count > 50, 'red-text': result_count <= 50 || result_count ===  'Вы ввели много '}">{{ result_count }} символов</em>
          <textarea class="form-control form-control-sm z-depth-1" rows="5" v-model="comment"></textarea>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-md-7 d-flex justify-content-end">
          <button class="btn btn-outline-white btn-sm waves-effect" role="button" @click.prevent="storeComment" style="color: #e91e63 !important;" :disabled="send"> отправить
            <i class="fa fa-angle-double-right fa-15x ml-2" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </form>



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
      name: '',
      email: '',
      comment: '',
      send: false,
      count_simbols: 1000
    }
  },

  computed: {
    result_count() {
      var count = this.count_simbols - this.comment.length;
      if(count <= 0) count = 'Вы ввели много ';
      return count;
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
      this.send = true;
      axios.post('/comment/create/' + this.article_id, {
        name: this.name,
        email: this.email,
        content: this.comment
      }).then(response => {
        this.showMessage = true;
        this.name = '';
        this.email = '';
        this.comment = '';
        this.messages = response.data.message;
        this.hiddenTimeOutMess();
        this.send = false;
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
        this.send = false;
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
