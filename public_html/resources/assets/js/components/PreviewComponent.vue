<template lang="html">

  <div class="container-fluid p-5">

    <div class="row">
      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (1).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
      <div class="col-md-3 border-bottom border-top" id="art-prev">
        <img src="/public/storage/images/previews/1 (2).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (3).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
      <div class="col-md-3 border border-left-0" id="art-prev">
        <img src="/public/storage/images/previews/1 (4).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (6).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
      <div class="col-md-3 border-bottom border-top" id="art-prev">
        <img src="/public/storage/images/previews/1 (12).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (8).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
      <div class="col-md-3 border border-left-0" id="art-prev">
        <img src="/public/storage/images/previews/1 (9).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
      </div>
    </div>

  </div>

</template>

<script>
export default {
  data() {
    return {

    }
  },

  mounted() {
    console.log(this.divHeight);
  },

  computed: {
    divWidth() {
      return $('.col-md-3')[0].offsetWidth;
    },
    divHeight() {
      return $('.col-md-3')[5].offsetHeight;
    }
  },

  methods: {

  }
}
</script>

<style lang="css">
#art-prev {
  overflow: hidden;
  padding-right: 0px;
  padding-left: 0px;
}

.img-preview {
  height: 100%;
}

</style>
