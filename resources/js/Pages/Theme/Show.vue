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

const answer = ({ user, content: comment, time }: IMessages) => {
    const title = `<p class="title-answer">Answer user @${user.id} ${user.name} : ${time}</p`;
    const editor = content.value;

    editor.innerHTML = ` ${title} <blockquote class="blockquote">${comment}</blockquote>`
}

const complaint = (message: IMessageReport) => {
    MessagesService.complaint(message).then(()=>{

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
