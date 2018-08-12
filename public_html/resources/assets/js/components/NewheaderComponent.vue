<template lang="html">
  <div v-if="screenWidth">
    <div class="container-fluid p-0" style="height:100%">
      <!--Carousel Wrapper-->
      <div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-3" data-ride="carousel">
          <!--Slides-->
          <div class="carousel-inner" role="listbox">
              <div class="carousel-item view" v-for="(category, index) in categories" :class="{active: index === 0}">
                  <img class="d-block" :src="'/public/storage/' + category.img_path" alt="First slide">
                  <div class="mask flex-center waves-effect waves-light rgba-black-strong">
                  </div>
                  <div class="row slogan d-flex pt-5">
                    <div class="col-md-7">
                      <div class="row justify-content-center">
                        <div class="col-md-9">
                          <h1 class="display-3 text-uppercase white-text">
                            {{ category.header }}
                          </h1>
                          <h1 class="dispaly-4 text-uppercase white-text my-5">
                            {{ category.description }}
                          </h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-10 d-flex justify-content-end">
                          <a href="#" class="btn btn-outline-white btn-lg waves-effect" role="button"> перейти к разделу <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
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
          <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <div class="row globus">
            <div class="col-md-4 offset-md-8">
              <img src="/public/storage/images/site_0/Russia-2.png" class="img-fluid" style="max-height:450px" alt="Rossia">
            </div>
          </div>
          <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
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
    console.log(this.categories);
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
  width: 100%;
  top: 20%;
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

.btn-outline-white {
  z-index: 9999;
  border: 2px solid #ffffff !important;
  background-color: transparent !important;
  color: #ffffff !important;
}
</style>
