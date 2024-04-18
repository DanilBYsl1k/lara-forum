<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";

import { IBranchInterface } from "@/interface/BranchInterface";
import ThemeService from "@/services/ThemeService";

interface IProps {
  branch: IBranchInterface
}

const props = defineProps<IProps>();

let description = ref<string>('');
let title = ref<string>('');

const store = (): void => {
    ThemeService.CreateTheme({ description: description.value, title: title.value, branch_id: props.branch.id });
}
</script>

<template>
  <MainLayout>
      <div class="theme">
          <section>
              <div class="container">
                  <h3>Add Theme</h3>
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
      </div>
  </MainLayout>
</template>

<style lang="scss" scoped>

</style>
