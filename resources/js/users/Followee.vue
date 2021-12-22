<template>
    <div class="container mt-4" style="max-width: 800px;">
    <div class="row">
        <div class="col-sm-12">
            <div v-for="(person, index) in followees" :key="index">
                <person :person=person></person>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import Person from './Person.vue'
export default {
  components: { Person },

    props: {
        followees: {
            type:Object,
        }
    },
}
</script>
