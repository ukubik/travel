<template lang="html">
  <div class="col-md-3 border art-prev" v-on:mouseenter="testF" v-on:mouseleave="testT">
    <transition name="slide-fade">
      <div class="front" v-show="test">
        <img :src="'/public/storage/' + article.img_prew_path" class="img-fluid" alt="preview" style="min-height: 270px;">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">{{ article.title }}</h2>
          </div>
        </div>
      </div>
    </transition>

    <transition name="slide-fade">
      <div class="back p-2" v-show="!test">
        <h5>
          {{ article.description }}
        </h5>
        <div class="row">
          <div class="col text-center">
            <a :href="'/article/' + article.id" class="btn btn-outline-white btn-lg waves-effect" role="button"> читать
              <i class="fa fa-angle-double-right fa-15x ml-2" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: [
    'article'
  ],

  data() {
    return {
      test: true
    }
  },

  mounted() {
    // console.log(this.divHeight);
  },

  computed: {
    divWidth() {
      return $('div.col-md-3').width();
    },

    divHeight() {
      return $('div.front').height();
    }
  },

  methods: {
    testF() {
      this.test = false;
    },
    testT() {
      this.test = true;
    },
  }
}
</script>

<style lang="css">
.slide-fade-enter-active {
  transition: all .2s ease;
}

.slide-fade-leave-active {
  transition: all .5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to {
  transform: translateX(300px);
  opacity: 0;
}

.art-prev {
  overflow: hidden;
  padding-right: 0px;
  padding-left: 0px;
  min-height: 272px;
  z-index: 1;
}

.art-prev:hover {
  cursor: pointer;
}

.img-preview {
  height: 100% !important;
  vertical-align: middle;
}

.preview-title {
  position: absolute;
  top: 40%;
  left: 10%;
  text-transform: uppercase;
  text-shadow: 1px 1px 2px black, 0 0 1em black;
}

.back {
  position: absolute;
  width: 100%;
  height: 100%;
  top:0;
  background-color: #3E4551;
  color: white;
  z-index: 0;
}
</style>
