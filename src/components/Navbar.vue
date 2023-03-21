<template>
  <b-navbar type="dark" variant="dark">
    <b-navbar-nav>
      <b-nav-item>
        <button class="btn btn-primary" @click.prevent="products">
          Continue Shopping
        </button></b-nav-item
      >
      <b-nav-item>
        <button class="btn btn-primary" @click="goToCart()">
          Go to Cart ({{ getTotal }})
        </button>
      </b-nav-item>
      <b-nav-item>
        <button class="btn btn-primary" @click="orders">
          Orders
        </button></b-nav-item
      >
      <b-nav-item>
        <button class="btn btn-primary" @click="goToAbout()">About Us</button>
      </b-nav-item>
    </b-navbar-nav>
  </b-navbar>
</template>
<script>
import router from "../router/index";
import axios from "axios";
export default {
  data() {
    return {
      cartItems: null,
    };
  },
  beforeMount() {
    this.getItems();
  },
  methods: {
    orders() {
      router.push("/Orders");
    },
    products() {
      // Perform registration logic here
      this.$router.push("/Products");
      // You can make an HTTP request to your backend here to register the user
    },
    goToCart() {
      router.push("/Cart");
    },
    goToAbout() {
      router.push("/AboutPage");
    },
    getItems() {
      axios
        .post("http://localhost:8888/cart.php", {
          function: "getCart",
          params: {
            usserID: localStorage.getItem("usserID"),
          },
        })
        .then((response) => {
          console.log(response.data);
          if (response.data != "0") {
            this.empty = false;
            this.cartItems = response.data;
          } else {
            this.empty = true;
          }
        });
    },
  },
  computed: {
    getTotal() {
      if (this.cartItems) {
        let total = 0;
        this.cartItems.forEach((item) => {
          total += 1;
        });
        return total;
      } else {
        return 0;
      }
    },
  },
};
</script>
<style>
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
  height: 40px;
}
</style>
