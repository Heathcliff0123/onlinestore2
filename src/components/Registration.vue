<template>
  <div class="registration-container">
    <h1>Register</h1>
    <form>
      <div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control" v-model="name" />
      </div>
      <div class="form-group">
        <label>Ussername:</label>
        <input type="text" class="form-control" v-model="ussername" />
      </div>
      <div class="form-group">
        <label>Password:</label>
        <input type="password" class="form-control" v-model="password" />
      </div>
      <div class="form-group">
        <label>Confirm Password:</label>
        <input type="password" class="form-control" v-model="confirmPassword" />
      </div>
      <div class="form-group">
        <label>address:</label>
        <input type="text" class="form-control" v-model="address" />
      </div>
      <button class="btn btn-primary" @click.prevent="register">
        Register
      </button>
      <div>
        <button class="btn btn-primary" @click="login">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import router from "../router/index";
export default {
  data() {
    return {
      name: "",
      ussername: "",
      password: "",
      confirmPassword: "",
      address: "",
    };
  },
  methods: {
    register() {
      // Perform registration logic here
      if (this.password == this.confirmPassword) {
        axios
          .post("http://localhost:8888/users.php", {
            function: "Register",
            params: {
              username: this.ussername,
              password: this.password,
              address: this.address,
              name: this.name,
            },
          })
          .then(function (response) {
            console.log(response.data);
            if (response.data != "0") {
              localStorage.setItem("usserID", response.data);
              router.push("/Products");
            } else {
              console.log(response.data);
              alert("Ussername already exists, please choose a new one");
            }
          });
      } else {
        Alert("Password and Confirm Password don't match!");
      }
      console.log(
        `Registering with email: ${this.ussername}, password: ${this.password}, and confirm password: ${this.confirmPassword} , ${this.address}`
      );
      // You can make an HTTP request to your backend here to register the user
    },
    login() {
      router.push("/");
    },
  },
};
</script>

<style scoped>
.registration-container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-group {
  margin-bottom: 10px;
}

.label {
  display: block;
  margin-bottom: 5px;
}

.form-control {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}
</style>
