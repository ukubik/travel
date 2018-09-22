<template lang="html">

  <!-- Просмотр категорий -->
  <div class="row my-4">

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

    <div class="col p-2 border-right border-bottom">
      <div class="card">
        <div class="row px-4 my-3">
          <div class="col">
            <img :src="'/public/storage/' + localCategory.img_path" :alt="localCategory.link_name" class="img-fluid z-depth-2" style="max-height:300px">
          </div>
          <div class="col border-bottom border-right">
            <input type="text" class="form-control form-control-sm mb-2" v-model="localCategory.link_name">
          </div>
          <div class="col border-bottom border-right">
            <input type="text" class="form-control form-control-sm mb-2" v-model="localCategory.menu_name">
          </div>
          <div class="col border-bottom border-right">
            <input type="text" class="form-control form-control-sm mb-2" v-model="localCategory.header">
          </div>
          <div class="col border-bottom border-right">
            <textarea class="form-control form-control-sm mb-1" rows="2" v-model="localCategory.description"></textarea>
          </div>
          <div class="col border-bottom border-right">
            <button class="btn btn-sm btn-default" v-if="localCategory.added_menu === 'Не в меню'" @click="updAddMenu(localCategory)">
              {{ localCategory.added_menu }}
            </button>
            <button class="btn btn-sm btn-success" v-if="localCategory.added_menu === 'В меню'" @click="updAddMenu(localCategory)">
              {{ localCategory.added_menu }}
            </button>
          </div>
          <div class="col border-bottom">
            <button type="button" class="btn btn-sm btn-success" @click.prevent="updateCat(localCategory)">изменить</button>
            <button type="button" class="btn btn-sm btn-danger" @click.prevent="delCat(localCategory)">удалить</button>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" :data-target="'#centralModalSm_' + localCategory.id">
              подкатегории
            </button>
            <sub-categories :category_id="localCategory.id"></sub-categories>
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
export default {
  props: [
    'category'
  ],

  data() {
    return {
      localCategory: this.category,
      showError: false,
      errors: [],
      showMessage: true,
      messages: [],
    }
  },

  created() {

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
      this.added_menu = category.added_menu === 'Не в меню' ? 'В меню' : 'Не в меню';
      axios.put('category/added_menu/' + category.id, {
        added_menu: this.added_menu
      }).then(response => {
        this.localCategory = response.data;
      }).catch(error => {
        this.showError = true;
        this.errors = _.flatten(_.toArray(error.response.data.errors));
        this.hiddenTimeOutErr();
      });
    },

    delCat(category) {
      axios.delete('/admin/categories/' + category.id).then(response => {
        location.reload();
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
