<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-sm ps-sm-4">
          <i class="far fa-user-circle fa-4x"></i>
          <p class="ps-2">{{ person.name }}</p>
        </div>
        <div v-if="userId !== person.id">
          <div class="col-sm text-sm-end">
            <!-- <follow-button
              :initial-is-followed-by="person.isFollowedBy(isUser)"
              :authorized="isLogin"
              :person_name="person.name"
            ></follow-button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    isLogin() {
      return this.$store.getters["auth/check"];
    },
    isUser() {
      return this.$store.getters["auth/user"];
    },
    userId() {
      return this.$store.getters["auth/id"];
    },
  },
  props: {
    person: {
      type: Object,
    },
  },
};
</script>
