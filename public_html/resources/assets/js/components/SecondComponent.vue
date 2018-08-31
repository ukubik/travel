<template lang="html">

  <div class="container white-text">

    <div class="row my-5 py-5">
      <div class="col text-center">
        <h1 class="display-3">{{ article.title }}</h1>
      </div>
    </div>

    <div class="row my-5">
      <div class="col">
        <h3 class="h3-responsive">
          {{ article.description }}
        </h3>
      </div>
    </div>

    <div class="row my-5">
      <div class="col text-center">
        <a :href="'/article/' + article.id" class="btn btn-outline-white btn-lg waves-effect" role="button"> перейти
          <i class="fa fa-angle-double-right fa-15x ml-2" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      article: {},
    }
  },

  mounted() {
    this.getRndArt();
  },

  methods: {
    getRndArt() {
      axios.get('/rnd-article').then(response => {
        this.article = response.data
      });
    },
  },
}
</script>

<style lang="css">
</style>
