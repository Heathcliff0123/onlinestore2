<template>
  <Navbar />
  <div class="about-page">
    <h1>About Us</h1>
    <p>
      Welcome to our online store for gaming enthusiasts! We are a team of
      passionate gamers who have come together to create a platform that offers
      the best selection of games to all our customers.
    </p>
    <p>
      Our store is built on the Vue 3 framework, which ensures a seamless and
      enjoyable browsing experience for all our visitors.
    </p>
    <h2>Our Collection</h2>
    <p>
      Our collection includes the latest and greatest titles from all genres,
      including action, adventure, strategy, sports, and many more. Whether you
      are a hardcore gamer or just starting, we have something for everyone.
    </p>
    <p>
      We believe in providing the highest quality games at affordable prices,
      and we are committed to ensuring that our customers have a great
      experience shopping with us.
    </p>
    <h2>Contact Us</h2>
    <p>
      If you have any questions or concerns, please don't hesitate to contact us
      at:
    </p>
    <ul>
      <li>Email: info@gamesstore.com</li>
      <li>Phone: 1-800-GAMES-STORE</li>
      <li>Address: 123 Main Street, Anytown, USA</li>
      <li>Website: letonnel.co.za</li>
    </ul>
  </div>
</template>

<script>
import Navbar from "./Navbar.vue";
export default {
  name: "AboutPage",
  components: {
    Navbar,
  },
};
</script>

<style>
.about-page {
  max-width: 800px;
  margin: 0 auto;
  padding: 40px;
  text-align: justify;
  color: white;
}
</style>
