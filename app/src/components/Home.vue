<template>
  <div class="controls">
    <div>
      <button v-on:click="getProducts">Show all products</button>
    </div>
    <div>
      <input type="text" v-model="product_id" placeholder="product id">
      <button v-on:click="getProduct">search</button>
    </div>
    <div>
      <input type="text" v-model="brand_name" placeholder="brand name">
      <button v-on:click="getBrandProducts">search</button>
    </div>
  </div>

  <div class="create-form-section">
    <h2>Create Product Form</h2>
    <Create @newProduct="productCreated"></Create>
  </div>

  <h1>{{request_name}}</h1>
  <div class="products" v-if="products.length">
    <Product v-for="product in products" :product="product" :key="product.id" v-on:click="updateProduct(product.id)"></Product>
  </div>
</template>

<style>
.create-form-section {
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-top: 20px;
  margin-bottom: 20px;
}
.controls {
  display: flex;
  margin: 5px;
  justify-content: center;
  align-items: center;
}
.controls button {
  height: 30px;
  background-color: green;
  color: white;
  cursor: pointer;
}
.controls div {
  margin-right: 10px;
}
.controls input {
  height: 30px;
  margin-right: 5px;
}
.products {
  display: flex;
  flex-wrap: wrap;
}
</style>

<script>
import axios from "axios";
import Product from "@/components/Product"
import Create from "@/components/Create"
export default {
  name: 'HomeComponent',
  components: {
    Product,
    Create
  },
  data() {
    return {
      newProduct: null,
      request_name: 'All products',
      brand_name: '',
      product_id: null,
      isAuthorized: false,
      products: []
    }
  },
  methods: {
    productCreated(product) {
      this.products.push(product)
    },
    updateProduct(id) {
      this.$router.push({name: 'Update', params: {id: id}})
    },
    async getBrandProducts() {
      let getProducts = await axios.get('http://localhost:88/api/product/brand/'+this.brand_name)
      this.products = getProducts.data
    },
    async getProducts() {
      let getProducts = await axios.get('http://localhost:88/api/products')
      this.products = getProducts.data
    },
    async getProduct() {
      if (this.product_id > 0) {
        let getProduct = await axios.get('http://localhost:88/api/product/'+this.product_id)
        this.products = getProduct.data ? [getProduct.data] : []
      } else {
        this.products = []
      }
    },
  },
  async mounted() {
    let auth_key = localStorage.getItem('auth_key')
    this.isAuthorized = auth_key !== null
    await this.getProducts()
  }
}
</script>