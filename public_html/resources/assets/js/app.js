
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
  Vue.component('intro-component', require('./components/IntroComponent.vue'));
  Vue.component('second-component', require('./components/SecondComponent.vue'));
  Vue.component('now-reading', require('./components/NowReadingComponent.vue'));
  Vue.component('preview-component', require('./components/PreviewComponent.vue'));
  Vue.component('lower-block', require('./components/LowerBlockComponent.vue'));

  // Секция админа
  Vue.component('img-category', require('./components/admin/ImgCategory.vue'));
  Vue.component('images-component', require('./components/admin/ImagesComponent.vue'));
  Vue.component('category-component', require('./components/admin/CategoryComponent.vue'));
  Vue.component('article-component', require('./components/admin/ArticleComponent.vue'));
  Vue.component('new-category', require('./components/admin/NewCategoryComponent.vue'));

const app = new Vue({
    el: '#app'
});
