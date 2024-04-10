<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { IDefault } from "@/interface/DefaultInterface";

interface IProps {
    branch: IDefault;
}

defineProps<IProps>();

</script>

<template>
    <MainLayout>
        <div class="container">
            <h1>{{ branch.title }}</h1>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
