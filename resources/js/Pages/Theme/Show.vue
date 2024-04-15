<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";
import axios from "axios";

import { IThemes } from "@/interface/Temes";
import { IMessages } from "@/interface/Messages";

interface IProps {
    theme: IThemes
}

const props = defineProps<IProps>();
let content = ref();

const store = () => {
    axios.post(`/messages`, { content: content.value.innerHTML, theme_id: props.theme.id })
        .then(() => {
            content.value.innerHTML = '';
        })
}

const toggleLike = (message: IMessages) => {
    axios.post(`/messages/${message.id}/likes`, {})
        .then(() => {
            message.is_liked = !message.is_liked;

            message.is_liked ? ++message.likes : --message.likes;
        });
}

const answer = ({ user, content: comment, time }: IMessages) => {
    const title = `<p class="title-answer">Answer user @${user.id} ${user.name} : ${time}</p`;
    const editor = content.value;

    editor.innerHTML = ` ${title} <blockquote class="blockquote">${comment}</blockquote>`
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
                                    <p><em>
                                        <time :datetime="message.time">{{ message.time }}</time>
                                    </em></p>
                                </div>

                                <div class="theme__message-content-text">
                                    <div>
                                        <p v-html="message.content"></p>
                                    </div>
                                    <div class="theme__message-content-likes">
                                        <div>
                                            <button @click="answer(message)" class="button">quotes</button>
                                        </div>
                                        <span>
                                            {{ message.likes }}
                                        </span>
                                        <button @click="toggleLike(message)" class="like button-non-hover">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 :class="[message.is_liked ? 'fill-red-700' : '',  'w-6 h-6']">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                                            </svg>
                                        </button>
                                    </div>
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
@import "/resources/scss/vars/colors";
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

    &__message-content-text {
        display: flex;
        align-items: end;
        justify-content: space-between;
    }

    &__message-content-likes {
        display: flex;
        align-items: center;
        gap: rem-calc(10);
    }

    h6 {
        font-size: rem-calc(25);
        font-weight: 700;
        text-transform: capitalize;
    }

    .like {
        cursor: pointer;
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

.theme__message-field {
    .title-answer {
        background: red !important;
    }
}
.blockquote {
    border-left: rem-calc(2) solid $accent-color;
    background: #9b0000;
}

</style>
