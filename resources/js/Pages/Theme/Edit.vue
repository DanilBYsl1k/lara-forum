<script setup lang="ts">

import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

import { IThemes } from "@/interface/Temes";

interface IProps {
    theme: IThemes
}

const props = defineProps<IProps>();

let description = ref(props.theme.description);
let title = ref(props.theme.title);

const update = () => {
    router.patch(`/themes/${props.theme.id}`, { title: title.value, description: description.value } );
}
</script>

<template>
    <MainLayout>
        <section>
            <div class="container">
                <h3>Edit Theme: {{ title }}</h3>
            </div>
        </section>

        <section>
            <div class="container">
                <div>
                    <input v-model="title" type="text" placeholder="title">
                </div>
                <div>
          <textarea v-model="description" id="story" name="story" placeholder="overview" rows="5" cols="33">
              {{ description }}
          </textarea>
                </div>
                <div>
                    <a class="button" @click.prevent="update" href="">Add theme</a>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>

</style>
