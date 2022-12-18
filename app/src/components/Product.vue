<template>
  <div class="product">
    <p>
      <span style="color: red">id</span>: {{mutableProduct.id}}
    </p>
    <p>
      <span style="color: red">name</span>: {{mutableProduct.name}}
    </p>
    <p>
      <span style="color: red">category_name</span>: {{mutableProduct.category_name}}
    </p>
    <p>
      <span style="color: red">brand_name</span>: {{mutableProduct.brand_name}}
    </p>
    <p>
      <span style="color: red">price</span>: {{mutableProduct.price}}
    </p>
    <p>
      <span style="color: red">status</span>: {{mutableProduct.status_name}}
    </p>
  </div>
</template>

<style>
.product {
  cursor: pointer;
  border: 1px solid black;
  margin-left: 20px;
  margin-bottom: 20px;
  width: 250px;
  padding: 5px;
}
.product p {
  display: flex;
}
</style>

<script>
export default {
  name: 'ProductComponent',
  props: ['product'],
  data() {
    return {
      mutableProduct: {}
    }
  },
  mounted() {
    this.mutableProduct = this.product
    if (this.mutableProduct.status === 2) {
      this.mutableProduct.price = "Цена по запросу"
    }
    delete this.mutableProduct.status
  }
}
</script>