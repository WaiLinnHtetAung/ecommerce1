<template>
  <v-app id="app" class="app">
    <transition v-if="!auth" name="fade" mode="out-in">
      <Register v-if="!isLogin" @goLogin="isLogin = true" />
      <Login v-else @goRegister="isLogin = false" />
    </transition>
    <Layout v-else />
  </v-app>
</template>

<script>
import Layout from "./components/Layout.vue";

import Register from "./components/Register.vue";
import Login from "./components/Login.vue";
import { mapGetters } from "vuex";
export default {
  name: "App",
  props: ['user'],
  data() {
    return {
      isLogin: false,
    };
  },
  components: {
    Layout,
    Register,
    Login,
  },
  computed: {
    ...mapGetters(["auth"]),
  },
  methods: {},
  mounted() {
    this.$store.dispatch("checkUserStill", { data: this.user, router: this.$router }).then(() => {

    });
  },
};
</script>
<style scoped >
.app {
  width: 100%;
  height: 100%;
  background: #fff;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease-out;
}

.fade-leave-to,
.fade-enter-from {
  opacity: 0;
}
</style>
