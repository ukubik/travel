<template lang="html">
  <div class="container-fluid">

    <!-- Фон -->
    <div class="row">
      <div class="col px-0">
        <div class="parallax-bg">
          <img id="" class="img-fluid bg-1" :src="'/public/storage/' + category.img_path" alt="cloud">
        </div>
      </div>
    </div>

    <div class="row ct-content" id="">
      <div class="col-md-8 offset-md-2">
        <h1 class="display-2">{{ category.header }}</h1>
      </div>
    </div>


  </div>
</template>

<script>
export default {
  props: [
    'category'
  ],

  data() {
    return {

    }
  },

  mounted() {
    // console.log(this.category)
    $(window).bind('scroll', e => {
        this.parallaxScroll();
    });
  },

  methods: {
    parallaxScroll(){
        var scrolled = $(window).scrollTop();
        $('.parallax-bg').css('top',(0+(scrolled*.25))+'px');
    }
  }
}
</script>

<style lang="css">

#manned-flight {
  position: relative;
  top: 0px;
  min-height: 400px;
}

article {
  display: block;
}

.parallax-bg {
  z-index: -1;
  position: relative;
  top: 0;
  width: 100%;
}

.bg-1 {
  position: relative;
  opacity: 0.2;
}

.ct-content {
  background-color: #fff;
  max-width: 100%;
  height: auto;
  position: relative;
  bottom: 580px;
}
</style>
