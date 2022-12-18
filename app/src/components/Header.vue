<template>
  <div class="header">
    <a href="/">Home</a>
    <a href="/login">Login</a>
    <a href="/signup">Sign Up</a>
    <a href="#" v-on:click="logout">Log out</a>
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
export default {
  name: 'HeaderComponent',
  methods: {
    logout() {
      localStorage.removeItem('auth_key')
      this.$router.push({name: 'Login'})
    }
  }
}
</script>