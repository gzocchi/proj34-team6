<template>
  <div class="card" style="width: 18rem">
    <img
      :src="'/storage/' + restaurant.bg_image"
      class="card-img-top"
      :alt="restaurant.slug"
    />
    <div class="card-body">
      <h5 class="card-title">{{ restaurant.name }}</h5>
      <router-link
        class="btn btn-block btn-primary"
        :to="{ name: 'restaurant', params: { slug: restaurant.slug } }"
        >Menu</router-link
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "RestaurantCard",
  props: {
    restaurant: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
