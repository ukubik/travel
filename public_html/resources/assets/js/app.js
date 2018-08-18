
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

  Vue.component('newheader-component', require('./components/NewheaderComponent.vue'));
  Vue.component('category-component', require('./components/CategoryComponent.vue'));

  // Секция админа
  Vue.component('img-category', require('./components/admin/ImgCategory.vue'));
  Vue.component('images-component', require('./components/admin/ImagesComponent.vue'));
  Vue.component('categories-component', require('./components/admin/CategoriesComponent.vue'));
  Vue.component('article-component', require('./components/admin/ArticleComponent.vue'));

const app = new Vue({
    el: '#app'
});
