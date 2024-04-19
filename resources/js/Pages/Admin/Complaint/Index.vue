<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { IMessageReport } from "@/interface/Messages";
import TableElement from "@/Components/TableElement.vue";

export interface IProps {
    complaints: IMessageReport[]
}

const props = defineProps<IProps>();

// const resolve = computed((elem)=> {
//     return
// })
</script>

<template>
    <AdminLayout>
        <section>
            <h2>Complaints</h2>
            <hr>

            <table>
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Complain</th>
                    <th scope="col">№ message</th>
                    <th scope="col">User id</th>
                    <th scope="col">Solved</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="complaint in complaints">
                        <TableElement :complaint="complaint"></TableElement>
                    </template>

                </tbody>

            </table>
        </section>
    </AdminLayout>
</template>

<style scoped lang="scss">

table {
    width: 100%;
}
tr {
    display: grid;
    grid-template-columns:  5% 1fr 1fr 1fr 1fr;
    text-align: center;
}

thead {
    background: darkgrey;
    color: white;
    border-bottom: 1px solid black;
    th {
        text-align: center;
    }
}

.tbody {
    text-align: center;
}
</style>
