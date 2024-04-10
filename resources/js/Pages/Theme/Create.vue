<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

import { IBranchInterface } from "@/interface/BranchInterface";

interface IProps {
  branch: IBranchInterface
}

const props = defineProps<IProps>();

let description = ref('');
let title = ref('');

const store = () => {
  router.post('/themes', { description: description.value, title: title.value, branch_id: props.branch.id });
}
</script>

<template>
  <MainLayout>
    <section>
      <div class="container">
          <h3>Add Theme</h3>
        {{ branch.id }}
      </div>
    </section>

    <section>
      <div class="container">
        <div>
          <input v-model="title" type="text" placeholder="title">
        </div>
        <div>
          <textarea v-model="description" id="story" name="story" placeholder="overview" rows="5" cols="33">
          </textarea>
        </div>
        <div>
          <a class="button" @click.prevent="store" href="">Add theme</a>
        </div>
      </div>
    </section>
  </MainLayout>
</template>

<style scoped>

</style>
