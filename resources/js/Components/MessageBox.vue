<script setup lang="ts">
import { IMessages } from "@/interface/Messages";
import { ref } from "vue";

interface IProps {
    message: IMessages;
}

defineProps<IProps>()

const emit = defineEmits([ 'toggleLike', 'answer', 'complaint' ]);
const body = ref('');
let complaintBox = ref(false);

const complaint = (message: IMessages)=> {
    emit('complaint', { body: body.value ,...message });
    body.value = '';
    message.is_not_solved_complaint = !message.is_not_solved_complaint
    complaintBox.value = !complaintBox.value
}

</script>
<template>
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
            <div class="complain-review" v-if="message.is_not_solved_complaint">
                <p>
                    complaint on review
                </p>
            </div>
            <div class="theme__message-content-text">
                <div>
                    <p v-html="message.content"></p>
                </div>
                <div class="theme__message-content-likes">
                    <button @click="complaintBox = !complaintBox " class="button  warn">complain</button>

                    <button @click="emit('answer', message)" class="button">quotes</button>
                    <span>
                        {{ message.likes }}
                    </span>

                    <button @click="emit('toggleLike', message)" class="like button-non-hover">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor"
                             :class="[message.is_liked ? 'fill-red-700' : '',  'w-6 h-6']">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div v-if="complaintBox" class="complain-box">
                <input v-model="body" class="input-complain" type="text" placeholder="your complaint">
                <button @click="complaint(message)" class="button">Send complain</button>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import "/resources/scss/vars/colors";
@import "/resources/scss/func/rem-calc";

.theme {

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

    .complain-box {
        .input-complain {
            margin-top: rem-calc(20);
            width: 100%;
        }

        .button {
            margin-top: rem-calc(20);

        }
    }

    .complain-review {

        color: $white;
        background: #ef7171;
        padding: rem-calc(10 15);
        font-weight: 900;
        text-transform: uppercase;
        border-left: rem-calc(7) solid #591717;
        margin: rem-calc(10 0);
    }
}
</style>
