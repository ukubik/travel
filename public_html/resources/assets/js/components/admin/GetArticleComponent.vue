<template lang="html">
  <th scope="row">{{ article.title }}</th>
</template>

<script>
export default {
  props: {
    article: Object
  },

  data() {
    return {
      localId: this.id,
      article: {
        title: ''
      }
    }
  },

  mounted() {
    // this.getArticle();
    this.$emit('change-page');
  },

  methods: {
		getArticle() {
			axios.get('get-comm-article/' + this.localId).then(response => {
				this.article = response.data;
			});
		},
  }
}
</script>

<style lang="css">
</style>
