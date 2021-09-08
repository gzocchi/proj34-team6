<template>
    <div>
        <h1>{{ cartLs.list()[0].restaurant_id }}</h1>
        <h2>{{ cartLs.list()[0].name }}</h2>
        <h5>{{ cartLs.total() }} €</h5>


        <button>finalmente paga</button>
        
    </div>

    

</template>

<script>
import * as cartLs from "cart-localstorage";

export default {
    name: 'Payment',
    data() {
        return {
        cartLs,
        }
    }
}
</script>

<style>

</style>