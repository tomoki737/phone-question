<template>
    <div class="col-sm-1">
    <div class="dropdown d-flex flex-row-reverse">
        <i class="fas fa-ellipsis-v btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if($questionModal || $answerModal)
            @if($questionModal)
            <router-link v-bind:to="{ name: 'questions.edit' }">
            <li><a class="dropdown-item">編集</a></li>
            </router-link>
            <li id="show-btn" @click="$bvModal.show('bv-modal-example')" >削除</li>
        </ul>
<div>
  <b-modal id="bv-modal-example" hide-footer>
    <template #modal-title>
      Using <code>$bvModal</code> Methods
    </template>
    <div class="d-block text-center">
      <h3>Hello From This Modal!</h3>
    </div>
    <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Close Me</b-button>
  </b-modal>
 </div>
</div>
</template>
