<template>
    <section class="text-center py-5 my-5">
        <h1>Home Page</h1>

        <div class="types row">

            <div class="col-md-4" v-for="type in types" :key="type.id">
                <h6>{{type.name}}</h6>
                <router-link :to="{ name: 'type', params: { slug: type.slug } }"
        >ristoranti</router-link>
            </div>
            
        </div>
    </section>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            srvApi: "http://127.0.0.1:8000",
            types: []
        };
    },
    mounted() {
        this.getTypes();
    },
    methods: {
        getTypes() {
            axios
                .get(`${this.srvApi}/api/types`)
                .then(res => {
                    this.types = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
