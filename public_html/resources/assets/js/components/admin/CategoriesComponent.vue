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
            <li>
                {{ messages }}
            </li>
        </ul>
      </div>
    </transition>

    <!-- Просмотр категорий -->
    <div class="row my-4">
      <div class="col p-2 border-right border-bottom">
        <h5>Категории статей</h5>
        <div class="card">
          <div class="row px-4 my-3" v-for="category in localCategories">
            <div class="col">
              <img :src="'/public/storage/' + category.img_path" :alt="category.link_name" class="img-fluid" style="max-height:300px">
            </div>
            <div class="col border-bottom border-right">
              <input type="text" class="form-control form-control-sm mb-2" v-model="category.link_name">
            </div>
            <div class="col border-bottom border-right">
              <input type="text" class="form-control form-control-sm mb-2" v-model="category.menu_name">
            </div>
            <div class="col border-bottom border-right">
              <input type="text" class="form-control form-control-sm mb-2" v-model="category.header">
            </div>
            <div class="col border-bottom border-right">
              <textarea class="form-control form-control-sm mb-1" rows="2" v-model="category.description"></textarea>
            </div>
            <div class="col border-bottom border-right">
              <button class="btn btn-sm btn-default" v-if="category.added_menu === 'Не в меню'" @click="updAddMenu(category)">
                {{ category.added_menu }}
              </button>
              <button class="btn btn-sm btn-success" v-if="category.added_menu === 'В меню'">
                {{ category.added_menu }}
              </button>
            </div>
            <div class="col border-bottom">
              <button type="button" class="btn btn-sm btn-success" @click.prevent="updateCat(category)">изменить</button>
              <button type="button" class="btn btn-sm btn-danger" @click.prevent="delCat(category)">удалить</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Создание категории -->
      <div class="col p-2 border-bottom">
        <h5>Добавить категорию</h5>
        <!-- <div class="row"> -->
          <form>
            <div class="form-row">
              <div class="col border rounded">
                <p>Добавить фото</p>
                <div class="custom-file">
                  <input type="file" id="file" ref="file" accept="image/*" v-on:change="handleFilesUpload()"/>
                </div>
              </div>
              <div class="col">
                <label for="#validationLinkName"> <small>Ссылка на категорию</small>  <span class="red-text">*</span> </label>
                <input type="text" class="form-control" id="validationName" v-model="link_name">
              </div>
              <div class="col">
                <label for="#validationMenuName"> <small>Имя в меню</small>  <span class="red-text">*</span> </label>
                <input type="text" class="form-control" id="validationMenuName" v-model="menu_name">
              </div>
              <div class="col">
                <label for="#validationHeader"> <small>Заголовок</small>  <span class="red-text">*</span> </label>
                <input type="text" class="form-control" id="validationHeader" v-model="header">
              </div>
              <div class="col">
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
      link_name: '',
      menu_name: '',
      header: '',
      description: '',
      added_menu: '',
      file: '',
      showError: false,
      errors: [],
      showMessage: true,
      messages: [],
    }
  },

  mounted() {
    console.log(this.categories)
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

    handleFilesUpload(){
      this.file = this.$refs.file.files[0];
    },

    storeCat() {
      // console.log(this.file);
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('link_name', this.link_name);
      formData.append('menu_name', this.menu_name);
      formData.append('header', this.header);
      formData.append('description', this.description);
      // formData.append('added_menu', this.added_menu);
      axios.post('/admin/categories',
        formData, {
          headers: {'Content-Type': 'multipart/form-data'}
      }).then(response => {
        this.localCategories = response.data;
        this.file = '';
        this.link_name = '';
        this.menu_name = '';
        this.header = '';
        this.description = '';
        // this.added_menu = '';
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    updateCat(category) {
      axios.patch('/admin/categories/' + category.id, {
        link_name: category.link_name,
        menu_name: category.menu_name,
        header: category.header,
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

    // Обновление поля added_menu
    updAddMenu(category) {
      axios.put('/category/added_menu/' + category.id, {
        added_menu: this.added_menu
      }).then(response => {
        this.localCategories = response.data
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },

    delCat(category) {
      axios.delete('/admin/categories/' + category.id).then(response => {
        this.localCategories = response.data;
      }).catch(error => {
        this.errors = [(_.toArray(error.response.data)[0])];
        this.showError = true;
        this.hiddenTimeOutErr();
      });
    },
  }
}
</script>

<style lang="css">
</style>
