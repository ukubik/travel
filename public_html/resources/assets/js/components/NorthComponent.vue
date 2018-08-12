<template lang="html">

  <div class="container-fluid mt-5 pt-5" style="height:600px">
    <div class="row my-5">
      <div class="col text-center">
        <h1 class="display-3 text-uppercase mb-5">северные территории</h1>
        <!--Carousel Wrapper-->
        <div id="carousel-example-1z" class="carousel slide carousel-fade my-5 carusel-categories" data-ride="carousel">
            <!--Slides-->
            <!--First slide-->
              <div class="carousel-item active view">
                  <img class="d-block" src="/public/storage/images/site_12/north.png" alt="First slide">
              </div>
              <!--/First slide-->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item view" v-for="image in images">
                    <img class="d-block" :src="'/public/storage/' + image.path" alt="First slide">
                </div>
            </div>
            <!--/.Slides-->
        </div>
        <!--/.Carousel Wrapper-->
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: [
    'images'
  ],

  data() {
    return {

    }
  },

  mounted() {
    // console.log(this.images)
  }
}
</script>

<style lang="css">
.carusel-categories {
  opacity: 0.1;
  height: 100%;
  overflow: hidden;
}
</style>
