<template>
  <div style="display: flex; justify-content: center">
    <form class="create-form">
      <input type="text" v-model="Product.name" placeholder="name">
      <input type="text" v-model="Product.category_name" placeholder="category">
      <input type="text" v-model="Product.brand_name" placeholder="brand">
      <input type="number" v-model="Product.price" placeholder="price">
      <select v-model="Product.status">
        <option value="1">В наличии</option>
        <option value="2">Под заказ</option>
      </select>
      <button type="button" v-on:click="saveForm" class="create-btn">Save</button>
    </form>
  </div>
</template>

<style>
.create-form {
  display: flex;
  flex-direction: column;
  width: 300px;
}
.create-form input {
  height: 20px;
}
.create-form * {
  margin-bottom: 5px;
}
.create-btn {
  height: 30px;
  background-color: green;
  color: white;
  cursor: pointer;
}
</style>

<script>
import {VueElement} from "vue";

export default {
  name: 'CreateProduct',
  data() {
    return {
      Product: {
        name: "",
        category_name: "",
        brand_name: "",
        price: null,
        status: 1
      }
    }
  },
  methods: {
    async saveForm() {
      let request = await VueElement.prototype.$request.call(
          'post',
          '/api/product/create',
          this.Product,
      )
      if (request.data.success) {
        this.$emit('newProduct', request.data.product)
      }
    }
  }
}
</script>