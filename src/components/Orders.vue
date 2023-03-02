<template>
  <div class="order-list">
    <h1>Order History</h1>
    <table>
      <thead>
        <tr>
          <th>Order Number</th>
          <th>Date</th>
          <th>Drop Off Date</th>
          <th>Total Cost</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(order, index) in orders" :key="index">
          <td>{{ order.id }}</td>
          <td>{{ order.orderDate }}</td>
          <td>{{ order.deliveryDate }}</td>
          <td>R{{ order.total }}</td>
        </tr>
      </tbody>
    </table>
    <p>To confirm order please send proof of payment to:</p>
    <p>Example@gmail.com</p>
    <button class="btn btn-primary" @click.prevent="products">
      Continue Shopping
    </button>
    <button @click="goToCart()">Go to Cart</button>
  </div>
</template>

<script>
import { mounted, beforeMount } from "vue";
import router from "../router/index";
import axios from "axios";
export default {
  data() {
    return {
      orders: null,
    };
  },
  beforeMount() {
    axios
      .post("http://localhost:8888/order.php", {
        function: "getOrders",
        params: {
          ID: localStorage.getItem("usserID"),
        },
      })
      .then((response) => {
        this.orders = response.data;
      });
  },
  components: {
    beforeMount,
    mounted,
  },
  methods: {
    products() {
      // Perform registration logic here
      this.$router.push("/Products");
      // You can make an HTTP request to your backend here to register the user
    },
    goToCart() {
      router.push("/Cart");
    },
  },
};
</script>

<style scoped>
.order-list {
  margin: 20px;
}

.order-list h1 {
  font-size: 2em;
  margin-bottom: 10px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  text-align: left;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;

  color: #333;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
  color: #333;
}
tr:nth-child(odd) {
  background-color: #333;
  color: #f2f2f2;
}
.order-list p {
  color: #f2f2f2;
}

ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

ul li {
  margin-bottom: 5px;
}
</style>
