<template>
  <div class="edit-user">
    <h2>Edit User Information</h2>
    <form>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="user.nickName" />
      </div>
      <div class="form-group">
        <label for="email">Ussername:</label>
        <input type="type" id="email" v-model="user.username" />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="user.password" />
      </div>
      <div class="form-group">
        <label for="address">address:</label>
        <input type="text" id="address" v-model="user.address" />
      </div>
      <button @click="products" type="button" class="btn btn-primary">
        Start Shopping
      </button>
    </form>
  </div>
</template>

<script>
import { mounted, beforeMount } from "vue";
import router from "../router/index";
import axios from "axios";
export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        address: "",
      },
    };
  },
  beforeMount() {
    axios
      .post("http://localhost:8888/users.php", {
        function: "getData",
        params: {
          ID: localStorage.getItem("usserID"),
        },
      })
      .then((response) => {
        console.log(response.data);
        this.user = response.data;
      });
  },
  components: {
    beforeMount,
    mounted,
  },
  methods: {
    products() {
      //console.log(this.user.username);
      router.push("/Products");
      // Code to save changes to the user object goes here
    },
  },
};
</script>

<style>
.edit-user {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.edit-user h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ddd;
}

button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #0069d9;
}
</style>
