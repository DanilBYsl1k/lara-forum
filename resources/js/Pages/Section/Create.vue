<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

import MainLayout from "@/Layouts/MainLayout.vue";
import SectionsService from "@/services/SectionsService";

let title = ref<string>('');

const store = (): void => {
    SectionsService.CreateSection(title.value)
}

</script>

<template>
    <MainLayout>
        <section>
            <div class="container">
                <h3>Add section</h3>

                <div class="form">
                    <div>
                        <input type="text" v-model="title" name="" id="">
                    </div>
                    <div class="btn-container">
                        <Link class="button" @click.prevent="store" href="#">Add section</Link>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>

</style>
