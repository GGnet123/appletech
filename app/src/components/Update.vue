<template>
  <div class="update-form-container">
    <div class="error">
      <p v-for="(error, key) in errors" :key="key">{{error}}</p>
    </div>
    <div style="display: flex; justify-content: center">
      <form class="update-form">
        <input type="text" v-model="Product.name" placeholder="name">
        <input type="text" v-model="Product.category_name" placeholder="category">
        <input type="text" v-model="Product.brand_name" placeholder="brand">
        <input type="number" v-model="Product.price" placeholder="price">
        <select v-model="Product.status">
          <option value="1">В наличии</option>
          <option value="2">Под заказ</option>
        </select>
        <button type="button" v-on:click="saveForm" class="update-btn">Save</button>
      </form>
    </div>
  </div>
</template>

<style>
.update-form-container {
  margin-top: 20px;
}
.update-form {
  display: flex;
  flex-direction: column;
  width: 300px;
}
.update-form input {
  height: 20px;
}
.update-form * {
  margin-bottom: 5px;
}
.update-btn {
  height: 30px;
  background-color: green;
  color: white;
  cursor: pointer;
}
</style>

<script>
import {VueElement} from "vue";

export default {
  name: 'UpdateProduct',
  data() {
    return {
      errors: {},
      Product: {
        id: 0,
        name: "",
        category_name: "",
        brand_name: "",
        price: null,
        status: 1
      }
    }
  },
  mounted() {
    this.Product.id = this.$router.currentRoute._value.params.id
    this.getProduct()
  },
  methods: {
    async getProduct() {
      let request = await VueElement.prototype.$request.call('get','/api/product/'+this.Product.id)
      this.Product = request.data
    },
    async saveForm() {
      let request = await VueElement.prototype.$request.call(
          'patch',
          '/api/product/update/'+ this.Product.id,
          this.Product
      )
      if (request.data.success) {
        alert('Success')
        this.$router.push({name: 'Home'})
      } else {
        this.errors = request.data.errors
      }
    }
  }
}
</script>