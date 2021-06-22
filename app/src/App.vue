<template>
  <div id="app">
    <div class="main">
      <div class="main__header">
        <Header />
      </div>
      <div class="main__body">
        <div class="main__body__content">
          <transition name="fade">
            <div class="container my-3">
              <router-view></router-view>
            </div>
          </transition>
        </div>
        <div class="main__body__footer">
          <Footer />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "@/components/_layout/Header";
import Footer from "@/components/_layout/Footer";

export default {
  components: {
    Header,
    Footer,
  },
};
</script>
