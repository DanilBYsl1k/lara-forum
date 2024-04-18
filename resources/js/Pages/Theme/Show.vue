<script setup lang="ts">

import { ref } from "vue";

import MainLayout from "@/Layouts/MainLayout.vue";
import MessageBox from "@/Components/MessageBox.vue";
import { IThemes } from "@/interface/Temes";
import { IMessageReport, IMessages } from "@/interface/Messages";
import MessagesService from "@/services/MessagesService"

interface IProps {
    theme: IThemes
}

const props = defineProps<IProps>();
let content = ref();
let imgMessage = ref();
const store = async () => {
    await MessagesService.sendMessage(content.value.innerHTML, props.theme.id)
        .then(() => {
            content.value.innerHTML = '';
        });
}

const toggleLike = async (message: IMessages) => {
    await MessagesService.toggleLike(message.id)
        .then(() => {
            message.is_liked = !message.is_liked;
            message.is_liked ? ++message.likes : --message.likes;
        });
}

const complaint = (message: IMessageReport) => {
    MessagesService.complaint(message)
}

const storeImage = ({ target }: Event) => {
    const inputElement = target as HTMLInputElement;
    const [ file ] = inputElement.files!;

    const formData = new FormData();
    formData.append('image', file);
    formData.append('_method', 'patch');

    MessagesService.uploadImgMessage(formData)
        .then(({ data }) => data)
        .then(({ url, id }) => {
            uploadImage(url, id);
        })
}

const uploadImage = (url: string, id: number) => {
    const editor = content.value;
    editor.innerHTML = `${editor.innerHTML}<div><img data-img_id="${id}" src="${url}" alt="img"></div>`;
}

const answer = ({ user, content: comment, time }: IMessages) => {
    const title = `<p class="title-answer">Answer user @${user.id} ${user.name} : ${time}</p`;
    const editor = content.value;

    editor.innerHTML = ` ${title} <blockquote class="blockquote">${comment}</blockquote>`
}

const uploadImgMessage = () => {
    imgMessage.value.click()
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
                        <MessageBox
                            @answer="answer"
                            @toggle-like="toggleLike"
                            @complaint="complaint"
                            :message="message"/>
                    </template>
                </div>
            </section>

            <section class="theme__edit-wrapper">
                <div class="container">
                    <div class="theme__edit">
                        <h2>Add messages</h2>
                        <div class="">
                            <a @click.prevent="uploadImgMessage" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                </svg>
                            </a>
                            <div hidden>
                                <input @change="storeImage" ref="imgMessage" type="file">
                            </div>
                        </div>
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
