<template>
  <footer class="p-3 text-white bg-dark text-center">
    <p class="m-0">SELECTY SOFTWARE© {{ year }}</p>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>
