<template lang="html">
  <div class="row m-2 border rounded z-depth-2">
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
            <li v-for="message in messages">
                {{ message }}
            </li>
        </ul>
      </div>
    </transition>


    <div class="col border m-1">
      <img :src="'/public/storage/' + localArticle.img_prew_path" :alt="localArticle.menu_name" v-if="localArticle.img_prew_path" class="img-fluid m-1 z-depth-1" style="max-height:100px"> <br>
      <h6 v-if="!localArticle.img_prew_path">Добавить фото</h6>
      <div class="custom-file" v-if="!localArticle.img_prew_path">
        <input type="file" id="file" ref="file" accept="image/*" v-on:change="handleFilesUpload()"/>
      </div>
      <button class="btn btn-default btn-sm" v-if="!localArticle.img_prew_path" @click.prevent="addImg()">save image</button>
      <button class="btn btn-danger btn-sm" v-if="localArticle.img_prew_path" @click.prevent="delImg()">delete image</button>
    </div>


    <div class="col border m-1">
      <label for="title"> <small>Введите или измените значение</small> </label>
      <input type="text" id="title" class="form-control form-control-sm" v-model="meta.title">
    </div>
    <div class="col border m-1">
      <label for="keywords"> <small>Введите или измените значение</small> </label>
      <input type="text" id="keywords" class="form-control form-control-sm" v-model="meta.keywords">
    </div>
    <div class="col border m-1 pb-2">
      <label for="description"> <small>Введите или измените значение</small> </label>
      <textarea class="form-control form-control-sm" rows="5" v-model="meta.description"></textarea>
    </div>
    <div class="col border m-1">
      <button class="btn btn-sm btn-success" v-if="localArticle.published === 'Не опубликована'" @click.prevent="published('Опубликована')">опубликовать</button>
      <button class="btn btn-sm btn-success" v-if="localArticle.published === 'Опубликована'" @click.prevent="published('Не опубликована')">снять с публикации</button>
      <a :href="'/admin/article/' + localArticle.id" class="btn btn-sm btn-secondary">просмотр</a>
      <button class="btn btn-sm btn-primary" @click.prevent="storeMeta" v-if="meta.id === 0">save metatags</button>
      <button class="btn btn-sm btn-purple" @click.prevent="updMeta" v-if="meta.id !== 0">update metatags</button>
      <button class="btn btn-sm btn-danger" v-if="meta.id === 0 && !localArticle.img_prew_path" @click.prevent="destroyArt">удалить статью</button>
      <button class="btn btn-sm btn-danger" v-if="meta.id !== 0" @click.prevent="destroyMeta">удалить metatags</button>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'article'
  ],

  data() {
    return {
      localArticle: this.article,
      file: '',
      showError: false,
      errors: [],
      showMessage: true,
      messages: [],
      meta: {
        id: 0,
        title: '',
        keywords: '',
        description: '',
      }
    }
  },

  mounted() {
    this.getMeta();
  },

  methods: {
    getMeta() {
      axios.get('/admin/metatag/?id=' + this.article.id).then(response => {
        if(response.data) this.meta = response.data;
      });
    },

    handleFilesUpload() {
      this.file = this.$refs.file.files[0];
    },

    addImg() {
      let formData = new FormData();
      formData.append('file', this.file);
      axios.post('/admin/img-article/' + this.article.id,
        formData, {
          headers: {'Content-Type': 'multipart/form-data'}
      }).then(response => {
        this.localArticle = response.data;
        this.file = '';
      }).catch(error => {
        this.errors = error.response.data;
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    published(published) {
      axios.patch('/admin/article/published/', {
        id: this.localArticle.id,
        published: published
      }).then(response => {
        this.localArticle = response.data
      }).catch(error => {
        this.errors = error.response.data;
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    storeMeta() {
      axios.post('/admin/metatag', {
        article_id: this.localArticle.id,
        title: this.meta.title,
        keywords: this.meta.keywords,
        description: this.meta.description,
      }).then(response => {
        this.meta = response.data
      }).catch(error => {
        this.errors = error.response.data;
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    updMeta() {
      axios.put('/admin/metatag/' + this.meta.id, {
        title: this.meta.title,
        keywords: this.meta.keywords,
        description: this.meta.description,
      }).then(response => {
        this.meta = response.data;
        this.showMessage = true;
        this.messages = ['Изменено'];
        this.hiddenTimeOutMess();
      }).catch(error => {
        this.errors = error.response.data;
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    destroyMeta() {
      if(this.meta.id !== 0) {
        axios.delete('/admin/metatag/' + this.meta.id).then(response => {
          this.meta.id = 0;
          this.meta.title = '';
          this.meta.keywords = '';
          this.meta.description = '';
        });
      }
    },

    destroyArt() {
      axios.delete('/admin/article/' + this.localArticle.id).then(response => {
        location.reload();
      }).catch(error => {
        this.showError = true;
        this.errors = [error.response.data.message];
        this.hiddenTimeOutErr();
      });
    },

    delImg() {
      axios.put('/admin/article/del-img', {
        id: this.localArticle.id
      }).then(response => {
        this.localArticle = response.data
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
