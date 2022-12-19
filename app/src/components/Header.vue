<template>
  <div class="header">
    <a href="/">Home</a>
    <a v-if="store.isGuest" href="/login">Login</a>
    <a v-if="store.isGuest" href="/signup">Sign Up</a>
    <a v-if="!store.isGuest" href="#" v-on:click="logout">Log out</a>
  </div>
</template>

<style>
.header {
  background-color: grey;
  overflow: hidden;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.header a {
  text-decoration: none;
  margin-right: 20px;
  color: white;
  font-size: 30px;
}
.header a:hover {
  color: burlywood;
}
</style>

<script>
import {store} from '@/utils/store';
export default {
  name: 'HeaderComponent',
  data() {
    return {
      store
    }
  },
  methods: {
    logout() {
      store.isGuest = true
      localStorage.removeItem('auth_key')
    }
  }
}
</script>