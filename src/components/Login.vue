<template>
  <div class="body">
    <h1>Login</h1>
    <form @submit.prevent="submit">
      <label>Ussername</label>
      <input v-model="ussername" type="text" required />

      <label>Password</label>
      <input v-model="password" type="text" required />
      <div class="submit">
        <button>Submit</button>
      </div>
      <div>
        <button @click="register">Register</button>
      </div>
    </form>
  </div>
</template>

<script>
import router from "../router/index";
import axios from "axios";
export default {
  data() {
    return { ussername: "", password: "", self: this };
  },

  methods: {
    submit() {
      axios
        .post("http://localhost:8888/users.php", {
          function: "Login",
          params: {
            username: this.ussername,
            password: this.password,
          },
        })
        .then(function (response) {
          console.log(response.data);

          if (response.data != "0") {
            localStorage.setItem("usserID", response.data);
            router.push("/Products");
          } else {
            alert("Ussername or Password incorrect.");
          }
        });
    },
    register() {
      router.push("/Registration");
    },
  },
};
</script>

<style>
body {
  background: black;
}
form {
  max-width: 420px;
  margin: 30px auto;
  background: black;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: #aaa;
  display: inline-block;
  margin: 25px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input,
select {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}
h1 {
  color: #fff;
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
.submit {
  text-align: center;
}
.body {
  background-color: black;
}
</style>
