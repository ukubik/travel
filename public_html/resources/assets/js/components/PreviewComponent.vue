<template lang="html">

  <div class="container-fluid p-5">

    <div class="row white-text">

      <div class="col-md-3 border" id="art-prev" v-on:mouseover="testF()"  v-on:mouseout="testT()">
        <transition name="slide-fade">
          <div class="front" v-show="test">
            <img src="/public/storage/images/previews/1 (1).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
            <div class="row preview-title">
              <div class="col">
                <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
              </div>
            </div>
          </div>
        </transition>

        <transition name="slide-fade">
          <div class="back p-2" v-show="!test">
            <p>
              Применяется оными товарищами в случае, когда в их
              наполовину готовое поделие необходимо воткнуть
              человеческий текст, пригодный для демонстрации заказчику
            </p>
          </div>
        </transition>
      </div>

      <div class="col-md-3 border-bottom border-top" id="art-prev">
        <img src="/public/storage/images/previews/1 (2).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>

      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (3).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>

      <div class="col-md-3 border border-left-0" id="art-prev">
        <img src="/public/storage/images/previews/1 (4).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="row white-text">
      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (6).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>

      <div class="col-md-3 border-bottom border-top" id="art-prev">
        <img src="/public/storage/images/previews/1 (12).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>

      <div class="col-md-3 border" id="art-prev">
        <img src="/public/storage/images/previews/1 (8).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>
      
      <div class="col-md-3 border border-left-0" id="art-prev">
        <img src="/public/storage/images/previews/1 (9).jpg" class="img-preview" alt="preview" v-bind:style="{width: divWidth + 'px'}">
        <div class="row preview-title">
          <div class="col">
            <h2 class="h2-responsive">Какой-то заголовок b tot ntrcn</h2>
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
export default {
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
      return $('.col-md-3')[0].offsetWidth;
    },
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
  transition: all .3s ease;
}

.slide-fade-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to {
  transform: translateY(300px);
  opacity: 0;
}

/* .slide-back-enter-active {
  transition: all .3s ease;
}

.slide-back-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-back-enter, .slide-back-leave-to {
  transform: translateX(300px);
  opacity: 1;
} */

#art-prev {
  overflow: hidden;
  padding-right: 0px;
  padding-left: 0px;
  z-index: 1;
}

#art-prev:hover {
  cursor: pointer;
}

.img-preview {
  height: 100%;
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
  /* left: -100%; */
  top:0;
  background-color: #3E4551;
  color: white;
  z-index: 0;
}

</style>
