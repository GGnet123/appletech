<template>
  <div class="alert">
    {{alertMsg}}
  </div>
  <h1>Log in</h1>

  <div class="login">
    <input type="text" v-model="username" placeholder="username">
    <div class="error" v-if="errors.username">
      <p v-for="(value, key) in errors.username" :key="key">
        {{value}}
      </p>
    </div>
    <input type="text" v-model="password" placeholder="password">
    <div class="error" v-if="errors.password">
      <p v-for="(value, key) in errors.password" :key="key">
        {{value}}
      </p>
    </div>
    <button id="login-btn" v-on:click="logIn">Log in</button>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'LogIn',
  data() {
    return {
      username: "",
      password: "",
      alertMsg: "",
      errors: {
        password: [],
        username: []
      },
    }
  },
  methods: {
    async logIn() {
      let res = await axios.post("http://localhost:88/api/auth/login", {
        username: this.username,
        password: this.password
      })

      if (res.data.errors) {
        this.errors.password = res.data.errors.password
        this.errors.username = res.data.errors.username
        this.alertMsg = ""
      } else {
        this.alertMsg = "Successful log in"
        localStorage.setItem('auth_key', res.data.auth_key)
        this.$router.push({name: 'Home'})
      }
    }
  }
}
</script>

<style>
.alert {
  color: green;
}
.error {
  color: red;
  font-size: 15px;
}
.login input {
  width: 300px;
  height: 60px;
  display: block;
  padding-left: 20px;
  margin: 20px auto 30px;
  border: 1px solid skyblue;
}
#login-btn {
  height: 40px;
  width: 320px;
  margin-top: 20px;
  background-color: skyblue;
  color: white;
  cursor: pointer;
}
</style>