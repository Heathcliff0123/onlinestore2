import { createRouter, createWebHistory } from "vue-router";
import Cart from "../components/Cart";
import Orders from "../components/Orders.vue";
import Products from "../components/Products.vue";
import Registration from "../components/Registration.vue";
import Login from "../components/Login.vue";
import EditDetails from "../components/EditDetails.vue";
import AboutPage from "../components/AboutPage.vue";

const routes = [
  {
    path: "/",
    name: "Login",
    component: Login,
  },
  {
    path: "/Cart",
    name: "Cart",
    component: Cart,
  },
  {
    path: "/Orders",
    name: "Orders",
    component: Orders,
  },
  {
    path: "/Products",
    name: "Products",
    component: Products,
  },
  {
    path: "/Registration",
    name: "Registration",
    component: Registration,
  },
  {
    path: "/EditDetails",
    name: "EditDetails",
    component: EditDetails,
  },
  {
    path: "/AboutPage",
    name: "AboutPage",
    component: AboutPage,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
