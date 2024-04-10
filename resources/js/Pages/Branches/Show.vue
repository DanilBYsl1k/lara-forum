<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";

import { IBranchWithChild } from "@/interface/BranchInterface";

interface IProps {
  branch: IBranchWithChild;
}

defineProps<IProps>();

</script>

<template>
  <MainLayout>
    <section>
      <div class="container">
        <div class="btn-container">
          <Link :href="route('branches.themes.create', branch.id)" class="button">Add theme</Link>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section__title">
          <h4> {{ branch.title }} </h4>
        </div>

        <div class="branch" v-if="branch.children">

          <template v-for="childBranch in branch.children" :key="branch.id">
            <div class="branch__box">
              <Link class="branch__title" :href="route('branches.show', childBranch.id)">
                <h4> {{ childBranch.title }} </h4>
              </Link>
              <div class="branch__edit">
                {{ childBranch.id }}
                <Link class="branch__edit-button edit" :href="route('branches.edit', childBranch.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                       stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path fill="white" stroke-linecap="round" stroke-linejoin="round"
                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                  </svg>
                </Link>
                <Link class="branch__edit-button delete" :href="route('branches.destroy', childBranch.id)"
                      method="delete">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                       stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                  </svg>
                </Link>
              </div>
            </div>
          </template>
        </div>
      </div>
    </section>
  </MainLayout>
</template>

<style scoped>

</style>
