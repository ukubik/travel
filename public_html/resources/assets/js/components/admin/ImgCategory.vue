<template lang="html">
  <div class="container-fluid">
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
            <li v-for="message in this.messages">
                {{ message }}
            </li>
        </ul>
      </div>
    </transition>

    <!-- Просмотр категорий -->
    <div class="row my-4">
      <div class="col-md-7 p-2 border-right border-bottom">
        <h5>Категории фото</h5>
        <div class="card">
          <div class="row px-4 my-3" v-for="category in localCategories">
            <div class="col-3 border-bottom border-right">
              <input type="text" class="form-control form-control-sm mb-2" v-model="category.name">
            </div>
            <div class="col-6 border-bottom border-right">
              <textarea class="form-control form-control-sm mb-1" rows="2" v-model="category.description"></textarea>
            </div>
            <div class="col-3 border-bottom">
              <button type="button" class="btn btn-sm btn-success" @click.prevent="updateCat(category)">изменить</button>
              <button type="button" class="btn btn-sm btn-danger float-right" @click.prevent="delCat(category)">удалить</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Создание категории -->
      <div class="col-md-5 p-2 border-bottom">
        <h5>Добавить категорию</h5>
        <!-- <div class="row"> -->
          <form>
            <div class="form-row">
              <div class="col-5">
                <label for="#validationName"> <small>Наименование категрии</small>  <span class="red-text">*</span> </label>
                <input type="text" class="form-control" id="validationName" v-model="name">
              </div>
              <div class="col-7">
                <label for="#description"> <small>Описание категрии</small></label>
                <textarea class="form-control" id="description" rows="2" v-model="description"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click.prevent="storeCat()">сохранить</button>
              </div>
            </div>
          </form>
        <!-- </div> -->

      </div>
    </div>

    <images-component v-bind:categories="localCategories"></images-component>
  </div>
</template>

<script>
export default {
  props: [
    'categories'
  ],

  data() {
    return {
      localCategories: this.categories,
      name: '',
      description: '',
      showError: false,
      errors: [],
      showMessage: true,
      messages: []
    }
  },

  methods: {
    storeCat() {
      axios.post('/admin/img-categories', {
        name: this.name,
        description: this.description
      }).then(response => {
        this.localCategories = response.data;
        this.name = '';
        this.description = '';
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    updateCat(category) {
      axios.patch('/admin/img-categories/' + category.id, {
        name: category.name,
        description: category.description
      }).then(response => {
        this.showMessage = true;
        this.messages = response.data.message;
        this.hiddenTimeOutMess();
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },

    delCat(category) {
      axios.delete('/admin/img-categories/' + category.id).then(response => {
        this.localCategories = response.data;
      }).catch(error => {
        this.errors = [(_.toArray(error.response.data)[0])];
        this.showError = true;
        this.hiddenTimeOutErr();
      });
    },

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
  }
}
</script>

<style lang="css">

</style>
