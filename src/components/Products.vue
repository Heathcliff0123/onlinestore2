<template>
  <div v-if="self.content" class="product-list">
    <h1>Products</h1>
    <button @click="goToCart()">Go to Cart</button>
    <div class="product-grid">
      <div
        v-for="(product, index) in self.products"
        :key="index"
        class="product-card"
      >
        <img
          :src="setImg(product.thumbnail)"
          :alt="product.name"
          class="product-image"
        />
        <div class="product-details">
          <h2>{{ product.name }}</h2>
          <p>{{ product.descr }}</p>
          <p>Price: R {{ product.price }}</p>
        </div>
        <button @click="addToCart(product)">Add to Cart</button>
      </div>
    </div>
  </div>
</template>

<script>
import { mounted, beforeMount } from "vue";
import router from "../router/index";
import axios from "axios";
export default {
  // mounted() {
  //   console.log(products);
  // },

  data() {
    return {
      self: this,
      content: false,
      products: null,
    };
  },
  beforeMount() {
    axios
      .post("http://localhost:8888/products.php", {
        function: "getProducts",
      })
      .then((response) => {
        this.products = response.data;
        this.content = true;
      });
  },
  components: {
    beforeMount,
    mounted,
  },
  methods: {
    addToCart(product) {
      // Add the product to the cart
      console.log(product);
      // You can make an HTTP request to your backend here to add the product to the cart
      axios
        .post("http://localhost:8888/cart.php", {
          function: "addCart",
          params: {
            productID: product.id,
            usserID: localStorage.getItem("usserID"),
          },
        })
        .then((response) => {
          console.log("1");
          console.log(response.data);
        });
    },
    goToCart() {
      router.push("/Cart");
    },
    setImg(thumbnail) {
      var img = require.context("./img/", false, /\.jpeg$/);
      return img("./" + thumbnail + ".jpeg");
    },
  },
};
</script>

<style scoped>
.product-list {
  margin: 20px;
  background: black;
}

.product-list h1 {
  font-size: 2em;
  margin-bottom: 10px;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  grid-gap: 20px;
}

.product-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 1px solid #ddd;
  padding: 10px;
  background-color: #ddd;
}

.product-image {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-bottom: 10px;
}

.product-details h2 {
  font-size: 1.5em;
  margin: 0;
}

button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

button:hover {
  background-color: #0069d9;
}
</style>
