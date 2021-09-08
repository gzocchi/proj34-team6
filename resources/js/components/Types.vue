<template>
  <div class="types row" v-if="!loading && types">
    <div
      class="type_card col-md-6"
      v-for="type in types"
      :key="type.id"
      :style="{ 'background-image': 'url(storage/' + type.image + ')' }"
    >
      <router-link :to="{ name: 'type', params: { slug: type.slug } }">
        <span>{{ type.name }}</span></router-link
      >
    </div>
  </div>

  <Loader v-else />
</template>

<script>
import Loader from "./Loader";

export default {
  name: "Types",
  components: { Loader },
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      types: [],
      loading: true,
    };
  },
  mounted() {
    this.getTypes();
  },
  methods: {
    getTypes() {
      axios
        .get(`${this.srvApi}/api/types`)
        .then((res) => {
          this.types = res.data;
          if (this.types.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
div.types {
  .type_card {
    text-align: center;

    a {
      display: block;
      padding: 100px 0;
      font-size: 2em;
      text-decoration: none;
      color: #e2004f;

      span {
        padding: 10px;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.5);
      }
    }
  }
}
</style>