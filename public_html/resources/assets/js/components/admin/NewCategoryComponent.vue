<template lang="html">
  <div class="row">
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
    <!-- Создание категории -->
    <div class="col p-2 border-bottom">
      <h5>Добавить категорию</h5>
      <!-- <div class="row"> -->
        <form>
          <div class="form-row">
            <div class="col border rounded">
              <p>Добавить фото <span class="red-text">(1920 х 840!)</span></p>
              <div class="custom-file">
                <input type="file" id="file" ref="file" accept="image/*" v-on:change="handleFilesUpload()"/>
              </div>
            </div>
<!--             <div class="col">
              <label for="#validationLinkName"> <small>Ссылка на категорию</small>  <span class="red-text"><i class="fa fa-asterisk" aria-hidden="true"></i></span> </label>
              <input type="text" class="form-control" id="validationName" v-model="link_name">
            </div> -->
            <div class="col">
              <label for="#validationMenuName"> <small>Имя в меню</small>  <span class="red-text"><i class="fa fa-asterisk" aria-hidden="true"></i></span> </label>
              <input type="text" class="form-control" id="validationMenuName" v-model="menu_name">
            </div>
            <div class="col">
              <label for="#validationHeader"> <small>Заголовок</small>  <span class="red-text"><i class="fa fa-asterisk" aria-hidden="true"></i></span> </label>
              <input type="text" class="form-control" id="validationHeader" v-model="header">
            </div>
            <div class="col">
              <label for="#description"> <small>Описание категрии</small>  <span class="red-text"><i class="fa fa-asterisk" aria-hidden="true"></i></span> </label>
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
</template>

<script>
export default {
  data() {
    return {
      // link_name: '',
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
      // formData.append('link_name', this.link_name);
      formData.append('menu_name', this.menu_name);
      formData.append('header', this.header);
      formData.append('description', this.description);
      axios.post('/admin/categories',
        formData, {
          headers: {'Content-Type': 'multipart/form-data'}
      }).then(response => {
        this.file = '';
        // this.link_name = '';
        this.menu_name = '';
        this.header = '';
        this.description = '';
        location.reload();
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },
  },
}
</script>

<style lang="css">
</style>
