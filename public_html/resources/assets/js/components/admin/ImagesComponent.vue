<template lang="html">
  <div class="container-fluid my-2">
    <transition name="fade">
      <div class="alert alert-danger" v-if="this.errors.length > 0" v-show="showError" id="alert">
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
    <div class="row">
      <div class="col text-center">
        <h3>{{ cat_name }}</h3>
      </div>
    </div>

    <div class="row border rounded z-depth-3">
      <div class="col text-center py-3 border hand" v-for="category in categories" v-on:click="getImages(category.id)" @click="catName(category.name, category.id)">
        <ins class="text-content">{{ category.name }}</ins>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="row my-3" v-if="images.length !== 0">
          <div class="col-3 my-2" v-for="image in images">
            <a data-toggle="modal" data-target="#exampleModal" @click="getImage(image.id)">
              <img v-bind:src="'/public/storage/' + image.path" alt="" class="img-thumbnail mx-auto d-block z-depth-3">
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <form>
          <div class="row mt-4" v-show="cat_id !== 0">
            <div class="col border rounded z-depth-3 py-2">
              <h5>Добавить фото</h5>
                <div class="custom-file">
                  <input type="file" id="files" ref="files" multiple accept="image/*" v-on:change="handleFilesUpload()"/>
                </div>
                <label for="desc"> <small> Добавьте описание под фото <span class="red-text" style="font-size:200%">*</span> (при выборе нескольких фото описание добавляется ко всем)</small> </label>
                <textarea class="form-control form-control-sm bg-dark white-text" rows="3" id="desc" v-model="description"></textarea>
                <button class="btn btn-sm btn-outline-success rounded text-uppercase waves-effect mt-3" v-on:click.prevent="submitFiles()">сохранить</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" v-if="img.path">
              <img v-bind:src="'/public/storage/' + img.path" class="img-fluid" style="height:100%">
                <div class="modal-footer">
                    <span class="black-text"> {{ img.description }}</span>
                    <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-sm btn-danger" @click="destroyImage(img.id)">Удалить</button>
                </div>
            </div>
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
      // local_categories: this.categories,
      cat_name: 'Выберите категорию из списка.',
      cat_id: 0,
      images: [],
      img: {},
      files: '',
      showError: false,
      errors: [],
      description: '',
    }
  },

  mounted() {

  },

  methods: {
    getImages(id) {
      axios.get('/admin/get-images/' + id).then(response => {
        this.images = response.data;
      });
    },

    handleFilesUpload(){
      this.files = this.$refs.files.files;
    },

    submitFiles(){
    let formData = new FormData();
    for( var i = 0; i < this.files.length; i++ ) {
        let file = this.files[i];
        formData.append('files[' + i + ']', file);
        formData.append('img_category_id', this.cat_id,);
        formData.append('description', this.description,);
      }
      axios.post('/admin/images',
      formData, {
        headers: {'Content-Type': 'multipart/form-data'}
      }).then(response => {
        this.files = '';
        this.getImages(this.cat_id);
      }).catch(error => {
        this.errors = error.response.data;
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr()
      });
    },

    catName(name, id) {
      this.cat_name = name;
      this.cat_id = id;
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

    destroyImage(id) {
      axios.delete('/admin/images/' + id).then(response => {
        this.getImages(this.cat_id);
        $('#exampleModal').modal('hide');
      }).catch(error => {

      });
    },

    getImage(id) {
      axios.get('/admin/images/' + id).then(response => {
        this.img = response.data;
      });
    }
  }
}
</script>

<style lang="css">
.hand:hover {
  cursor: pointer;
  background-color: #000;
}
.text-content {
  text-transform: uppercase;
  font-size: 14px;
  font-weight: 4400;
  color: #61CBE2;
}
.custom-file-label::after {
  content: 'Обзор' !important;
}
/* .fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
} */
</style>
