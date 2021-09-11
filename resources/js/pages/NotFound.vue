<template>
  <section class="my-5 text-center">
    <h1 class="text-danger">404</h1>
    <h3>Contenuto non trovato</h3>
    <h6>Stai per essere rendirizzato alla HomePage</h6>
  </section>
</template>

<script>
export default {
  name: "NotFound",
  mounted() {
    setTimeout(() => {
      this.$router.push({ name: "home" });
    }, 3000);
  },
};
</script>

<style lang="scss" scoped></style>
