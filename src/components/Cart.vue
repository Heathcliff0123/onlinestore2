<template>
  <Navbar />
  <div class="cart">
    <h1>My Cart</h1>
    <div v-if="!this.empty" class="cart-items">
      <div v-for="(item, index) in cartItems" :key="index" class="cart-item">
        <img
          :src="setImg(item.thumbnail)"
          :alt="item.name"
          class="item-image"
        />
        <div class="item-details">
          <h2>{{ item.name }}</h2>
          <p>Price: R{{ item.price }}</p>
          <p>Quantity: 1</p>
        </div>
        <button @click="removeItem(item.id)">Remove</button>
      </div>
    </div>
    <div v-if="!this.empty" class="cart-total">
      <p>Total: {{ getTotal }}</p>
      <button @click="checkout">Checkout</button>
    </div>
    <div v-if="this.empty" class="cart-total">
      <p>Your cart is empty</p>
    </div>
  </div>
</template>

<script>
import { mounted, beforeMount } from "vue";
import router from "../router/index";
import axios from "axios";
import Navbar from "./Navbar.vue";
export default {
  data() {
    return {
      cartItems: null,
      empty: true,
    };
  },
  beforeMount() {
    this.getItems();
  },
  components: {
    beforeMount,
    mounted,
    Navbar,
  },
  computed: {
    getTotal() {
      if (!this.empty) {
        let total = 0;
        this.cartItems.forEach((item) => {
          total += parseInt(item.price);
        });
        return total;
      } else {
        return 0;
      }
    },
  },
  methods: {
    removeItem(ID) {
      axios
        .post("http://localhost:8888/cart.php", {
          function: "removeCart",
          params: {
            cartID: ID,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.getItems();
        });
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
    checkout() {
      axios
        .post("http://localhost:8888/order.php", {
          function: "addOrder",
          params: {
            usserID: localStorage.getItem("usserID"),
            total: this.getTotal,
            date: new Date(),
            orderDate: new Date().getDate(),
            deliveryDate: this.deliveryDate(),
          },
        })
        .then((response) => {
          console.log(response.data);
          if (response.data == "1") {
            axios
              .post("http://localhost:8888/cart.php", {
                function: "removeUsserCart",
                params: {
                  usserID: localStorage.getItem("usserID"),
                },
              })
              .then((response) => {
                console.log(response.data);
                if (response.data == "1") {
                  router.push("/Orders");
                } else {
                  alert("checkout failed");
                }
              });
          } else {
            alert("checkout failed");
          }
        });
    },
    deliveryDate() {
      var result = new Date();
      result.setDate(result.getDate() + 5);
      return result;
    },
    setImg(thumbnail) {
      var img = require.context("./img/", false, /\.jpeg$/);
      return img("./" + thumbnail + ".jpeg");
    },
  },
};
</script>

<style scoped>
.cart {
  margin: 20px;
}

.cart h1 {
  font-size: 2em;
  margin-bottom: 10px;
}

.cart-items {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  background-color: #ddd;
}

.cart-item {
  display: flex;
  flex-direction: row;
  gap: 20px;
  align-items: center;
  border: 1px solid #ddd;
  padding: 10px;
  max-width: 500px;
}

.item-image {
  width: 100px;
  height: 100px;
  object-fit: contain;
}

.item-details h2 {
  font-size: 1.5em;
  margin: 0;
}

.item-details p {
  color: black;
}

.cart-total {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}

.cart-total p {
  font-size: 1.2em;
  margin: 0;
}

p {
  color: white;
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
