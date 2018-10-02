<template lang="html">
  <div>
    <div class="container-fluid p-0">
      <!--Carousel Wrapper-->
      <div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-3" data-ride="carousel">
          <!--Slides-->
          <div class="carousel-inner" role="listbox">
              <div class="carousel-item view" v-for="(category, index) in categories" :class="{active: index === 0}" v-if="category.link_name !== 'article_index'">
                  <img class="d-block" :class="{'img-fluid': screenWidth}" :src="'/public/storage/' + category.img_path" alt="First slide">
                  <div class="mask flex-center waves-effect waves-light rgba-black-strong">
                  </div>
                  <div class="row slogan pt-5">
                    <div class="col-md-7">
                      <div class="row d-flex justify-content-center">
                        <div class="col-md-9">
                          <h1 class="display-4 text-uppercase white-text">
                            {{ category.header }}
                          </h1>
                          <h2 class="dispaly-5 text-uppercase white-text my-5">
                            {{ category.description }}
                          </h2>
                        </div>
                      </div>
                      <div class="row" style="z-index:9999;">
                        <div class="col-md-10 d-flex justify-content-end" style="z-index:9999;">
                          <a :href="'/category/' + category.id" class="btn btn-outline-white btn-lg waves-effect" role="button"> перейти к разделу
                            <i class="fa fa-angle-double-right fa-15x ml-2" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next d-flex justify-content-end" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
      <div class="row globus" v-if="screenWidth">
        <div class="col-auto">
          <img src="/public/storage/images/site_0/Russia-2.png" class="img-fluid" style="max-height:450px" alt="Rossia">
        </div>
      </div>
    </div>

  </div>

</template>

<script>
export default {
  props: [
    'categories'
  ],

  data() {
    return {

    }
  },

  mounted() {
    // console.log(this.cats);
    // console.log(this.categories);
  },

  computed: {
    screenWidth() {
      if(screen.width >= 990) {
        return true;
      } else {
        return false;
      }
    },

    // categories() {
    //   return this.cats.splice(this.cats[0], 1);
    // }
  },
}
</script>

<style lang="css">
.btn .fa-15x {
  font-size: 1.5em !important;
}

.slogan {
  z-index: 0;
  position: absolute;
  width: 100%;
  top: 20%;
  left: 4%;
}

.globus {
  z-index: 0;
  position: absolute;
  width: 20%;
  top: 20%;
  right: 20%;
  opacity: 0.7;
}

.d-block {
  min-height: 300px;
  overflow: hidden;
}

.rgba-black-strong, .rgba-black-strong::after {
  background-color: rgba(0,0,0,.29);
}

.carousel-control-prev, .carousel-control-next {
  z-index: 999;
}

.carousel-control-prev-icon, .carousel-control-next-icon {
  width: 100px !important;
  height: 100px !important;
}
</style>
