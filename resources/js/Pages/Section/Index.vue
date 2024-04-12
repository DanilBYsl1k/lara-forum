<script setup lang="ts">
interface ISection extends IMainParams {
    branches: [IMainParams]
}

interface IProps {
    sections: ISection[];
}

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

import { IMainParams } from "@/interface/MainParams";

defineProps<IProps>();
</script>

<template>
    <MainLayout>
        <div class="index">
            <section class="main-title">
                <div class="container">
                    <div class="btn-container">
                        <Link :href="route('sections.create')" class="button">Add section</Link>
                        <Link :href="route('branches.create')" class="button">Add branch</Link>
                    </div>
                </div>
            </section>

            <section v-if="sections">
                <div class="container">
                    <div class="section" v-for="section in sections" :key="section.id">
                        <div class="section__title">
                            <h3> {{ section.title }} </h3>
                            <Link :href="route('sections.edit', section.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                </svg>
                            </Link>

                            <Link :href="route('sections.destroy', section.id)" method="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>
                            </Link>

                        </div>


                        <div class="branch" v-if="section.branches">
                            <template v-for="branch in section.branches" :key="branch.id">
                                <div class="branch__box">
                                    <Link class="branch__title" :href="route('branches.show', branch.id)">
                                        <h4> {{ branch.title }} </h4>
                                    </Link>
                                    <div class="branch__edit">
                                        {{ branch.id }}
                                        <Link class="branch__edit-button edit" :href="route('branches.edit', branch.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path fill="white" stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                            </svg>
                                        </Link>
                                        <Link class="branch__edit-button delete"  :href="route('branches.destroy', branch.id)" method="delete">
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
                </div>
            </section>
        </div>
    </MainLayout>
</template>

<style lang="scss" scoped>
@import '/resources/scss/func/rem-calc';
@import '/resources/scss/mixins/breakpionts';

.index {
    font-size: rem-calc(20);

    @include breakpoint(medium) {
        color: black;
    }
}

.section {
    &__title {
        font-size: rem-calc(30);
        border-bottom: rem-calc(1) solid grey;
        padding-bottom: rem-calc(10);
        display: flex;
        align-items: center;
        gap: rem-calc(10);
    }
}

.branch {
    &__box {
        font-size: rem-calc(20);
        background: white;
        border: rem-calc(1) solid black;
        padding: rem-calc(10 15);
        display: flex;
        justify-content: space-between;
        align-items: center;

        &:first-child {
            border-top: none;
        }
    }

    &__title {
        width: 100%;
        transition: 0.5s ease;

        &:hover {
            padding-left: rem-calc(20);
        }
    }

    &__edit {
        display: flex;
        align-items: center;
        gap: rem-calc(10);
    }

    .branch__edit-button {
        padding: rem-calc(10);
        border-radius: rem-calc(10);
        transition: 0.2s ease;
        &:hover {
            opacity: 0.5;
        }

        &.edit {
            background: #9370DB;
        }

        &.delete {
            background: crimson;
        }
    }
}


</style>
