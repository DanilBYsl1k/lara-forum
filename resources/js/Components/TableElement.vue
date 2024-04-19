<script setup lang="ts">

import { IMessageReport } from "@/interface/Messages";
import { computed } from "vue";

export interface IProps {
    complaint: IMessageReport
}

const props = defineProps<IProps>();

const resolve = computed(() => {
    return props.complaint.is_not_solved_complaint ? 'yes' : 'no';
})

</script>

<template>
    <tr>
        <td class="id">{{ complaint.id }}</td>
        <td>{{ complaint.body }}</td>
        <td>{{ complaint.message_id }}</td>
        <td>{{ complaint.user_id }}</td>
        <td>{{ resolve }}</td>
    </tr>
</template>

<style scoped lang="scss">
.id {
    background: rgba(156, 163, 175, 0.37);
}
</style>
