<template>
      <div>
          <nav-component></nav-component>
        <RouterView />
      </div>
</template>
<script>
import { INTERNAL_SERVER_ERROR } from './util'
import NavComponent from './components/NavComponent.vue'
export default {
  components: { NavComponent },
  computed: {
      errorCode() {
          return this.$store.auth.error.code;
      },
  },
  watch: {
      handler(val) {
          if(val === INTERNAL_SERVER_ERROR) {
              this.$router.push('/500');
          }
      },
      immedicate: true
  },
    $route() {
        this.$store.commit('error/setCode', null);
    }
}
</script>
