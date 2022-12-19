<template>
  <div class="alert">
    {{alertMsg}}
  </div>
  <h1>Sign Up</h1>

  <div class="register">
    <input type="text" v-model="username" placeholder="username">
    <div class="error" v-if="errors.username">
      <p v-for="(value, key) in errors.username" :key="key">
        {{value}}
      </p>
    </div>
    <input type="password" v-model="password" placeholder="password">
    <div class="error" v-if="errors.password">
      <p v-for="(value, key) in errors.password" :key="key">
        {{value}}
      </p>
    </div>
    <button id="signup-btn" v-on:click="signUp">Sign Up</button>
  </div>
</template>

<script>
import {VueElement} from "vue";
export default {
  name: 'SignUp',
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
    async signUp() {
      let res = await VueElement.prototype.$request.call('post',"/api/auth/register", {
        username: this.username,
        password: this.password
      })

      if (res.data.errors) {
        this.errors.password = res.data.errors.password
        this.errors.username = res.data.errors.username
        this.alertMsg = ""
      } else {
        this.alertMsg = "Success"
        this.$router.push({name: 'Login'})
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
.register input {
  width: 300px;
  height: 60px;
  display: block;
  padding-left: 20px;
  margin: 20px auto 30px;
  border: 1px solid skyblue;
}
#signup-btn {
  height: 40px;
  width: 320px;
  margin-top: 20px;
  background-color: skyblue;
  color: white;
  cursor: pointer;
}
</style>