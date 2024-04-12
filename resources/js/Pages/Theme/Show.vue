<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";
import axios from "axios";

import { IThemes } from "@/interface/Temes";

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

            <section v-if="theme.messages">
                <div class="container">
                    <template v-for="message in theme.messages">
                        <div class="theme__message-box">
                            <div class="theme__message-name">
                                <div class="user-logo">
                                    <img :src="message.user?.avatar" alt="">
                                </div>
                                <h6>
                                    {{ message.user.name }}
                                </h6>
                            </div>
                            <div class="theme__message-content">
                                <div>
                                    <p>
                                        <em>
                                            <time :datetime="message.time">{{ message.time }}</time>
                                        </em>
                                    </p>
                                </div>
                                <div>
                                    <p v-html="message.content"></p>
                                </div>
                            </div>
                        </div>

                    </template>
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

    &__message-box {
        border: rem-calc(1) solid black;
        border-radius: rem-calc(20);
        margin-bottom: rem-calc(10);
    }

    &__message-name {
        display: flex;
        align-items: center;
        gap: rem-calc(10);
        padding: rem-calc(20);
    }

    &__message-content {
        padding: rem-calc(10 20 20 20);
        border-top: rem-calc(1) solid black;
    }

    h6 {
        font-size: rem-calc(25);
        font-weight: 700;
        text-transform: capitalize;
    }

    .user-logo {
        width: rem-calc(40);
        height: rem-calc(40);
        border-radius: 100%;
        overflow: hidden;

        img {
            width: 100%;
            height: 100%;
        }
    }
}
</style>
