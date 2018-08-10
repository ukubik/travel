<template lang="html">
  <div v-if="screenWidth">
    <div class="container-fluid p-0">
      <!--Carousel Wrapper-->
      <div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-3" data-ride="carousel">
          <!--Slides-->
          <div class="carousel-inner" role="listbox">
            <!--First slide-->
              <div class="carousel-item active view">
                  <img class="d-block" src="/public/storage/images/site_11/startimage.png" alt="First slide">
                  <div class="mask flex-center waves-effect waves-light rgba-black-strong">
                  </div>
              </div>
              <!--/First slide-->
              <div class="carousel-item view" v-for="image in images">
                  <img class="d-block" :src="'/public/storage/' + image.path" alt="First slide">
                  <div class="mask flex-center waves-effect waves-light rgba-black-strong">
                  </div>
              </div>
          </div>
          <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
    </div>

    <!-- <div class="container"> -->
      <div class="row slogan mt-5 mr-0">
        <div class="col-md-8">
          <h1 class="display-3 text-uppercase white-text">
            заграница - это конечно здорово!
          </h1>
          <h1 class="dispaly-4 text-uppercase white-text my-5">
            но много ли вы знаете о своей стране?!
          </h1>
          <h1 class="dispaly-4 text-uppercase white-text my-5">
            предлагаем отправиться с нами в увлекатенейшее <br> путешествие по россии...
          </h1>
        </div>
        <div class="col-md-4 globus text-center">
          <img src="/public/storage/images/site_0/Russia-2.png" class="img-fluid" style="max-height:450px" alt="Rossia">
        </div>
      </div>
    <!-- </div> -->

    <!-- кнопка вниз -->
    <div class="arrow-scroll">
      <div class="arrow-scroll__wrap arrow-scroll__wrap_animated">
        <svg style="fill:#ffffff;" x="0px" y="0px" width="38.417px" height="18.592px" viewbox="0 0 38.417 18.592">
          <g>
            <path d="M19.208,18.592c-0.241,0-0.483-0.087-0.673-0.261L0.327,1.74c-0.408-0.372-0.438-1.004-0.066-1.413c0.372-0.409,1.004-0.439,1.413-0.066L19.208,16.24L36.743,0.261c0.411-0.372,1.042-0.342,1.413,0.066c0.372,0.408,0.343,1.041-0.065,1.413L19.881,18.332C19.691,18.505,19.449,18.592,19.208,18.592z"></path>
          </g>
        </svg>
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
    // console.log(this.scrollPosition);
  },

  computed: {
    screenWidth() {
      if(screen.width >= 990) {
        return true;
      } else {
        return false;
      }
    }
  },
}
</script>

<style lang="css">
.slogan {
  position: absolute;
  top: 20%;
  left: 5%;
}

.slogan h1 {
  font-weight: 700;
}

.globus {
  opacity: 0.6;
}

.d-block {
  min-height: 300px;
  overflow: hidden;
}

.rgba-black-strong, .rgba-black-strong::after {
  background-color: rgba(0,0,0,.29);
}

.arrow-scroll {
  position: absolute;
  text-align: center;
  z-index: 9;
  right: 0;
  left: 0;
  bottom: 180px;
}
.arrow-scroll__wrap {
  display: inline-block;
  transition: all ease-in-out 0.2s;
  cursor: pointer;
}
.arrow-scroll__wrap:hover {
  opacity: 0.5;
}
.arrow-scroll__wrap_animated {
  animation: arrow-scroll 1.7s infinite ease;
}
@keyframes arrow-scroll {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-7px);
  }
  55% {
    transform: translateY(-7px);
  }
  100% {
    transform: translateY(0);
  }
}

</style>
