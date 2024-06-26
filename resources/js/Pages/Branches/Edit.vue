<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

import MainLayout from "@/Layouts/MainLayout.vue";
import { IMainParams } from "@/interface/MainParams";
import { IBranchInterface } from "@/interface/BranchInterface";
import SectionsService from "@/services/SectionsService";
import BranchesService from "@/services/BranchesService";

interface IProps {
  sections: IMainParams[];
  branch: IBranchInterface;
  errors: any
}

type data = Omit<IBranchInterface, 'id'>

const { branch, sections } = defineProps<IProps>();

let branches = ref<[IBranchInterface]>();
let section = ref<data>({
  section_id: branch.section_id,
  parent_id: 0,
  title: branch.title,
});

onMounted(() => {
  getBranches();
})

const update = (): void => {
  BranchesService.updateBranches(branch.id, section.value);
}

const getBranches = (): void => {
    SectionsService.getBranchesExcept(section.value.section_id, branch.id).then(({ data }) => {
        branches.value = data
    })
}
</script>

<template>
  <MainLayout>
    <div class="branch-create">
      <div class="container">
        <h1>Edit Branch</h1>
        <div class="form">
          <template v-if="sections">
            <select @change="getBranches" v-model="section.section_id">
              <option value="null" selected disabled>Select chapter</option>
              <option v-for="section in sections"
                      :key="section.id"
                      :value="section.id">
                {{ section.title }}
              </option>
            </select>
            <template v-if="branches">
              <select v-model="section.parent_id">
                <option value="null" selected disabled>Select branch</option>
                <option v-for="branch in branches"
                        :key="branch.id"
                        :value="branch.id">
                  {{ branch.title }}
                </option>
              </select>
            </template>

            <div>
              <input v-model="section.title" type="text" placeholder="title">
              <template v-for="error in errors">
                <span class="error">{{ error }}</span>
              </template>
            </div>
            <div class="btn-container">
              <Link @click.prevent="update" class="button">Save</Link>
            </div>
          </template>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<style lang="scss" scoped>

</style>
