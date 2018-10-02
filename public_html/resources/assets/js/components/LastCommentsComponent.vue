<template lang="html">
  <div class="row my-4">
    <div class="col border rounded p-2 m-2">
      <h5 class="mb-5">Последние комментарии:</h5> <hr>
      <div class="row" v-for="comment in lastComments">
        <div class="col mb-2">
          <p class="font-weight-bold m-0">{{ comment.name }}</p>
          <p class="m-0 text-muted">{{ comment.created_at }}</p>
          <em style="font-size:90%">{{ comment.content }}</em><br>
          <a :href="'/article/' + comment.article_id" title="Статья комментария">Перейти к статье</a>
          <hr>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      lastComments: []
    }
  },

  created() {
    this.getLastComments();
  },

  methods: {
    getLastComments() {
      axios.get('/last-comments').then(response => {
        this.lastComments = response.data;
      });
    },
  }
}
</script>

<style lang="css">
hr {
  border: none; /* Убираем границу для браузера Firefox */
  color: grey; /* Цвет линии для остальных браузеров */
  background-color: grey; /* Цвет линии для браузера Firefox и Opera */
  height: 1px; /* Толщина линии */
}
</style>
