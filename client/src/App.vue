<script>
import Footer from "./components/global/Footer.vue";
import Navbar from './components/global/Navbar.vue';
export default {
    data() {},
    components: { Footer, Navbar, Navbar, },
};
</script>

<template>
    <Navbar />
    <router-view />
    <Footer />
</template>

<style lang="scss">
#app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
:root {
    $secColor: #91ffa2;
    $priColor: #0f9172;
}
</style>
