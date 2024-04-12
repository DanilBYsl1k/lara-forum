<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

import { IThemes } from "@/interface/Temes";
import axios from "axios";

interface IProps {
    theme: IThemes
}

let content = ref();
const props = defineProps<IProps>();

const store = () => {
    axios.post(`/messages`, { content: content.value.innerHTML, theme_id: props.theme.id })
        .then(() => {
            content.value.innerHTML = '';
        })
}
</script>

<template>
    <MainLayout>
        <div class="theme">
            <section class="theme__title">
                <div class="container">
                    <h2>Edit Theme: {{ theme.title }}</h2>
                </div>
            </section>

            <section class="theme__edit-wrapper">
                <div class="container">
                    <div class="theme__edit">
                        <h2>Add messages</h2>
                        <div class="theme__message-field" ref="content" contenteditable="true"></div>
                        <button class="button" @click="store">Add messages</button>
                    </div>
                </div>
            </section>
        </div>
    </MainLayout>
</template>

<style lang="scss" scoped>
@import "/resources/scss/func/rem-calc";

.theme {

    &__title {
        padding: rem-calc(20 0);
    }

    h2 {
        font-weight: 700;
        font-size: rem-calc(36);
    }

    &__edit {
        border: rem-calc(1) solid black;
        padding: rem-calc(20);
        border-radius: rem-calc(10);

        .button {
            margin-top: rem-calc(10);
        }
    }

    &__message-field {
        border: rem-calc(1) solid black;
        padding: rem-calc(10);
    }
}
</style>
