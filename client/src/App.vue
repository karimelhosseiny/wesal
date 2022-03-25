<script>
import Footer from "./components/global/Footer.vue"
export default{
  data(){

  },
  components:{ Footer,}
}
</script>

<template>
  <router-view/>
  <!-- <LoginPage/>
  <SignupPage/> -->
  <Footer/>
</template>

<style lang="scss">

#app {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
:root{
  $secColor: #91ffa2;
  $priColor: #0f9172;
}
</style>
