<template>
  <div
    class="type_card col-8 col-md-4 col-xl-3 p-0 mb-2 text-center"
    :style="this.bgImage()"
  >
    <router-link
      class="py-5 d-block font-weight-bold"
      :to="{ name: 'type', params: { slug: type.slug } }"
    >
      {{ type.name }}
    </router-link>
  </div>
</template>

<script>
export default {
  name: "TypeCard",
  data: function () {
    return {};
  },
  props: {
    type: {
      type: Object,
      required: true,
    },
  },
  methods: {
    bgImage() {
      let bgImagePath = "storage/types/" + this.type.slug + ".webp";
      return {
        backgroundImage: `url("${bgImagePath}")`,
      };
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.type_card {
  flex: 0 0 auto;
  overflow: hidden;
  border-radius: 10px;
  background-position: center;
  background-size: cover;
  background-color: $azure;
  &:not(:last-child) {
    margin-right: 10px;
  }

  a {
    font-size: 2em;
    text-decoration: none;
    color: $purple;
    background-color: rgba(255, 255, 255, 0.2);
    &:hover {
      transform: scale(1.2);
       background-color: rgba($azure, 0.8);
    }
  }
}
</style>
