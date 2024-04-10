<script setup lang="ts">
import MainLayout from "@/Layouts/MainLayout.vue";
import { IMainParams } from "@/interface/MainParams";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";

interface IProps {
    section: IMainParams
}

const { section } = defineProps<IProps>();

const title = ref<string>(section.title);

const store = () => {
    router.patch(`/sections/${section.id}`, {title: title.value});
}
</script>

<template>
    <MainLayout>
        <section>
            <div class="container">
                <h1>
                    Edit section
                </h1>

                <div class="form">
                    <div>
                        <input type="text" v-model="title" name="" id="">
                    </div>
                    <div class="btn-container">
                        <Link class="button" @click.prevent="store" href="#">Update section</Link>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>

</style>
