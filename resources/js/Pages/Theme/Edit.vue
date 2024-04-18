<script setup lang="ts">
import { ref } from "vue";

import MainLayout from "@/Layouts/MainLayout.vue";
import { IThemes } from "@/interface/Temes";
import ThemeService from "@/services/ThemeService";

interface IProps {
    theme: IThemes
}

const props = defineProps<IProps>();

let description = ref<string>(props.theme.description);
let title = ref<string>(props.theme.title);

const update = (): void => {
    ThemeService.updateTheme(props.theme.id, { title: title.value, description: description.value });
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
