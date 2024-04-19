<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";

interface IProps {
    stats: {
        title: string;
        'count': number;
    }[]
}

const props = defineProps<IProps>()

</script>

<template>
    <AdminLayout>
        <section>
            <div class="admin-section">
                <h3>Statistics</h3>
                <div v-if="stats">
                    <hr>
                    <div v-for="stat in stats">
                        <p><b>{{ stat.title }}</b>: {{ stat.count }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>

<style lang="scss" scoped>
admin-section {

}
</style>
