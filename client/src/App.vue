<script>
import Footer from "./components/global/Footer.vue";
import Navbar from "./components/global/Navbar.vue";
export default {
    data() {},
    components: { Footer, Navbar, Navbar },
};
</script>

<template>
    <router-view />
    <Footer />
</template>

<style lang="scss">
* {
    font-family: poppins;
}
#app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
:root {
    $secColor: #91ffa2;
    $priColor: #0f9172;
}
::-webkit-scrollbar {
    background-color: #ccc ;

}
::-webkit-scrollbar-track {
    background-color: #eee ;
}
::-webkit-scrollbar-thumb {
    background-color: #aaa ;
    border-radius: 10px ;
    height: 90% ;
}
</style>
