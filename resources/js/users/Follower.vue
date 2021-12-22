<template>
  <div>
    <div v-for="(follower, index) in user.followers" :key="index">
      <person :person="person"></person>
    </div>
  </div>
</template>

<script>
import Person from "./Person.vue";
export default {
  components: {
    Person,
  },
  props: {
    followers: {
      type: Object,
    },
  },
};
</script>
