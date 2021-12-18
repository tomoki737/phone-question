<template>
  <div>
    <button type="button" class="btn m-0 p-1 shadow-none">
      <i
        class="fas fa-thumbs-up"
        :class="{ 'text-primary': this.isLikedBy }"
        @click="clickLike"
      ></i>
    </button>
    {{ this.countLikes }}
  </div>
</template>

<script>
  export default {
    props: {
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      question_id: {
        type: Number,
      },
    },
    data() {
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
      }
    },

  methods: {

    clickLike() {
      if (!this.authorized) {
        alert("いいね機能はログイン中のみ使用できます");
        return;
      }
      this.isLikedBy ? this.unlike() : this.like();
    },
    async like() {
      console.log(this.question)
      console.log(this.isLikedBy)
      const response = await axios.put('/api/questions/' + this.question_id + '/like');
      this.isLikedBy = true;
      this.countLikes = response.data.countLikes;
    },

    async unlike() {
      const response = await axios.delete('/api/questions/' + this.question_id + '/unlike');
      this.isLikedBy = false;
      this.countLikes = response.data.countLikes;
    },
  },
}
</script>
