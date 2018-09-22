<template lang="html">
  <!-- Modal new subcategory -->
  <div class="modal fade" :id="'centralModalSm_' + category_id" tabindex="-1" role="dialog" :aria-labelledby="category_id + 'myModalLabel'" aria-hidden="true">

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

      <!-- Change class .modal-sm to change the size of the modal -->
      <div class="modal-dialog modal-fluid" role="document">


        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title w-100" :id="category_id + 'myModalLabel'">Подкатегории</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm table-bordered" v-show="subCategories.length !== 0">
              <thead class="thead-dark text-center">
                <tr>
                  <th scope="col">Ссылка на категорию</th>
                  <th scope="col">Наименование в меню</th>
                  <th scope="col">Описание</th>
                  <th scope="col">Действие</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in subCategories">
                  <td>{{ category.link_name }}</td>
                  <td>{{ category.title }}</td>
                  <td>{{ category.description }}</td>
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger waves-effect" @click.prevent="destroy(category)">удалить</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row mt-2">
              <div class="col p-2">
                <h5>Новая подкатегория</h5>
              </div>
            </div>
            <div class="row">
              <div class="col p-2">
                <input class="form-control form-control-sm" type="text" v-model="link_name" placeholder="Имя ссылки (латиница!)">
              </div>
              <div class="col p-2">
                <input class="form-control form-control-sm" type="text" v-model="title" placeholder="Имя в меню">
              </div>
              <div class="col p-2">
                <div class="form-group">
                  <textarea class="form-control" rows="2" v-model="description" placeholder="Краткое описание"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-sm" @click.prevent="storeSubCategory">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Central Modal Small -->
</template>

<script>
export default {
  props: [
    'category_id',
  ],

  data() {
    return {
      categories: this.subCategories,
      link_name: '',
      title: '',
      description: '',
      showError: false,
      errors: [],
      showMessage: true,
      messages: [],
      subCategories: [],
    }
  },

  mounted() {
    this.getSubCategories();
  },

  methods: {
    // получаем подкатегории
    getSubCategories() {
      axios.get('/admin/sub-category/' + this.category_id).then(response => {
        this.subCategories = response.data;
      });
    },

    // Удаление
    destroy(category) {
      axios.delete('/admin/sub-category/' + category.id).then(response => {
        this.getSubCategories();
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
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

    storeSubCategory() {
      axios.post('/admin/sub-category', {
        category_id: this.category_id,
        link_name: this.link_name,
        title: this.title,
        description: this.description
      }).then(response => {
        this.subCategories = response.data;
        link_name = '';
        title = '';
        description = ''
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },
  },
}
</script>

<style lang="css">
</style>
