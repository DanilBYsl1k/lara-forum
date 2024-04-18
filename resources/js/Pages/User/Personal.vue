<script setup lang="ts">
import MainLayout from "@/Layouts/MainLayout.vue";
import { IUser } from "@/interface/User";
import { ref } from "vue";
import axios from "axios";
import UserService from "@/services/UserService";

interface IProps {
    user: IUser
}


const props = defineProps<IProps>();

const avatarInput = ref();

const handleAvatarClick = () => {
    avatarInput.value.click();
}

const storeAvatar = ({ target } : Event) => {
    let [ file ] = target?.files;
    const formData = new FormData();
    formData.append('avatar', file);
    formData.append('_method', 'patch');

    UserService.userAvatar(formData).then(res => res.data).then(({ avatar }) => {
        props.user.avatar = avatar
    });
}

</script>

<template>
    <MainLayout>
        <div class="personal">
            <div class="container personal__container">
                <section class="personal__title-section">
                    <h3>Profile {{ user.name }} </h3>
                </section>
                <section class="personal__params-section">
                    <div>
                        <p>
                            Hi {{ user.name }}
                        </p>
                    </div>

                    <div class="change-avatar">
                        <h6>Change avatar</h6>
                        <a class="img-bg" href="#" @click.prevent="handleAvatarClick">
                            <img  :src="user.avatar" :alt="user.name + ' avatar'">
                        </a>

                        <div hidden>
                            <input @change="storeAvatar" ref="avatarInput" type="file">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped lang="scss">
@import '/resources/scss/func/rem-calc';

.personal__container {
    background: #f6f3f3;
    padding: rem-calc(20);
}

.img-bg {
    img {
        display: block;
        border-radius: 100%;
        //padding: rem-calc(10);
        width: rem-calc(40);
        height: rem-calc(40);
        background: #9ca3af;
    }
}
</style>
