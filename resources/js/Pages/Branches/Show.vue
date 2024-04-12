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
                <div>
                    <h2> sections </h2>
                </div>
                <div class="branch" v-if="branch.children">

                    <template v-for="childBranch in branch.children" :key="branch.id">
                        <div class="branch__box">
                            <div>
                                <Link class="branch__title" :href="route('branches.show', childBranch.id)">
                                    <div class="title">
                                        <h4> {{ childBranch.title }} </h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>


                                    </div>
                                </Link>
                            </div>
                            <div class="branch__edit">
                                {{ childBranch.id }}
                                <Link class="branch__edit-button edit" :href="route('branches.edit', childBranch.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path fill="white" stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                    </svg>
                                </Link>
                                <Link class="branch__edit-button delete"
                                      :href="route('branches.destroy', childBranch.id)"
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

                <div class="branch" v-if="branch.themes">
                    <div>
                        <h2> themes </h2>
                    </div>
                    <template v-for="themes in branch?.themes" :key="branch.id">
                        <div class="branch__box">
                            <div>
                                <Link class="branch__title" :href="route('themes.show', themes.id)">
                                    <div class="title">
                                        <h4> {{ themes.title }} </h4>
                                        <svg class="icon-title" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                            <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0  0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                        </svg>

                                    </div>
                                </Link>
                                <p>{{ themes.description }}</p>
                            </div>

                            <div class="branch__edit">
                                <Link class="branch__edit-button edit" :href="route('themes.edit', themes.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path fill="white" stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                    </svg>
                                </Link>
                                <Link class="branch__edit-button delete"
                                      :href="route('themes.destroy', themes.id)"
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

<style lang="scss" scoped>
@import '/resources/scss/func/_rem-calc.scss';

h2 {
    font-size: rem-calc(20);
    font-weight: bold;
    margin: rem-calc(10 0);
    text-transform: capitalize;
}

.branch__box {
    border-top: 1px solid;
}

 .branch__title {

     .title {
        display: flex;
         gap: rem-calc(10);;

         .icon-title {
             width: rem-calc(20);
         }
         transition: 0.5s ease;
         &:hover {
             padding-left: rem-calc(20);
         }
     }
 }
</style>
