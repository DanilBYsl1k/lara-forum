<script lang="ts" setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Header/>
    <main class="main">
        <div class="container main-container">
            <div class="content-section">
                <h3>Menu</h3>
                <hr>
                <ul>
                    <li><Link :href="route('admin.main.index')">Stats</Link></li>
                    <li><Link :href="route('admin.complaints.index')">Complaints</Link></li>
                </ul>
            </div>
            <div class="content-section">
                <slot></slot>
            </div>
        </div>
    </main>
    <Footer/>
</template>

<style lang="scss" scoped>
@import "../../scss/vars/colors";
@import "../../scss/func/rem-calc";
.main-container {
    margin-top: rem-calc(20);
    display: grid;
    grid-template-columns: 20% 1fr;
    gap: rem-calc(20);
}

.content-section {
    border: 1px solid;
    padding: rem-calc(20 15);
}
</style>
