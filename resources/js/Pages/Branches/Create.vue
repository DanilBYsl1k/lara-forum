<script setup lang="ts">
import axios from "axios";
import { Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

import MainLayout from "@/Layouts/MainLayout.vue";
import { IDefault } from "@/interface/DefaultInterface";

interface IProps {
    sections: [IDefault];
    errors: any
}

defineProps<IProps>();

let branches = ref(null);
let data = ref({
    section_id: null,
    parent_id: null,
    title: '',
});
const store = () => {
    router.post('/branches', {...data.value});
}
const getBranches = () => {
    console.log(data.value.section_id);
    axios.get(`/sections/${data.value.section_id}/branches`)
        .then(({data}) => {
            branches.value = data
        })
}
</script>

<template>
    <MainLayout>
        <div class="branch-create">
            <div class="container">
                <h1>Add Branch</h1>
                <div class="form">
                    <template v-if="sections">
                        <select @change="getBranches" v-model="data.section_id">
                            <option value="null" selected disabled>Select chapter</option>
                            <option v-for="section in sections"
                                    :key="section.id"
                                    :value="section.id">
                                {{ section.title }}
                            </option>
                        </select>
                        <template v-if="branches">
                            <select v-model="data.parent_id">
                                <option value="null" selected disabled>Select branch</option>
                                <option v-for="branch in branches"
                                        :key="branch.id"
                                        :value="branch.id">
                                    {{ branch.title }}
                                </option>
                            </select>
                        </template>

                        <div>
                            <input v-model="data.title" type="text" placeholder="title">
                            <template  v-for="error in errors">
                                <span class="error">{{ error }}</span>
                            </template>
                        </div>
                        <div class="btn-container">
                            <Link @click.prevent="store" class="button">Add</Link>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style lang="scss" scoped>

</style>
