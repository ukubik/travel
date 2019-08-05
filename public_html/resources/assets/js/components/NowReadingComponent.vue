<template lang="html">
  <div class="container-fluid">

    <div class="row my-4" v-for="article in articles">
      <div class="col">
        <!-- Card -->
        <div class="card">

          <!-- Card image -->
          <a :href="'/article/' + article.id">
            <img class="card-img-top hoverable" :src="'/public/storage/' + article.img_prew_path" alt="Card image cap">
          </a>

          <!-- Card content -->
          <div class="card-body">

            <!-- Title -->
            <h4 class="card-title"><a :href="'/article/' + article.id" class="text-dark">{{ article.title }}</a></h4>
            <!-- Text -->
            <p class="card-text">{{ article.description }}</p>

            <div class="row d-flex justify-content-between">
                <div class="col-auto text-muted">
                    <i class="fa fa-eye"></i> {{ article.article_view ? article.article_view.count : 0 }}
                    <i class="fa fa-comment ml-3"></i> {{ article.comments ? article.comments.length : 0 }}
                </div>
                <div class="col-auto">
                    <!-- Button -->
                    <a :href="'/article/' + article.id" class="btn btn-pink btn-lg waves-effect">читать</a>
                </div>
            </div>

          </div>

        </div>
        <!-- Card -->
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: [
    'article_id'
  ],

  data() {
    return {
      articles: {}
    }
  },

  mounted() {
    this.getRandomArt();
  },

  methods: {
    getRandomArt() {
      var id = this.article_id;
      if(this.article_id === undefined) id = '';
      axios.get('/get-random-art/' + id).then(response => {
        this.articles = response.data;
      });
    }
  }
}
</script>

<style lang="css">
.hoverable:hover {
  cursor: pointer;
}

.sticky-top {
  /* position: -webkit-sticky;
  position: sticky; */
  top: 70px;
  /* z-index: 1020; */
}
</style>
