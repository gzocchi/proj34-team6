<template>
  <section class="types" v-if="!loading && types">
    <div class="row mx-1">
      <TypeCard v-for="type in types" :key="type.id" :type="type" />
    </div>
  </section>
  <Loader v-else />
</template>

<script>
import Loader from "./Loader";
import TypeCard from "./TypeCard";

export default {
  name: "TypesNew",
  components: { Loader, TypeCard },
  data: function () {
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
          // console.log(res.data);
          this.types = res.data.data;

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
@import "../../sass/front";

@include scrollbars(10px, $purple);

.row {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}
</style>
