<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
       v-on:click="counter += 1"
    >
      <i class="fas fa-heart mr-1"
      />
    </button>
    {{counter}}
  </div>
</template>

<script>
export default{
     data() {
      return {
        counter: 0,
      };
    },
}
</script>
