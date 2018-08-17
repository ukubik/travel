<template lang="html">

  <div class="container-fluid">
    <div class="row my-3">
      <div class="col text-center">
        <h1>{{ article.title }}</h1>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <h4>Мета теги для статьи</h4>
        <input type="text" class="form-control form-control-sm" v-model="title">
      </div>
      <div class="col-md-6">

      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-12">
       <textarea name="editor1" id="editor1"></textarea>
     </div>
   </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      title: '',
      article: {
        title: 'Новая статья',
      },
    }
  },

  mounted() {

  },

  methods: {

  }
}
</script>

<style lang="css">
</style>
