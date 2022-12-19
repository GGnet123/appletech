<template>
  <Header></Header>
  <Loader :visible="store.showLoader"></Loader>
  <router-view></router-view>
</template>

<script>
import Header from "@/components/Header";
import Loader from "@/components/Loader";
import {store} from "@/utils/store";
export default {
  name: 'App',
  components: {
    Header,
    Loader
  },
  data() {
    return {
      store
    }
  }
}
</script>

<style>
body {
  padding: 0;
  margin: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
