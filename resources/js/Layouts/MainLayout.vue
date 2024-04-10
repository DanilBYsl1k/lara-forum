<script setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
</script>

<template>
    <Header/>
    <main>
        <div>
            <slot></slot>
        </div>
    </main>
    <Footer/>
</template>

<style scoped>

</style>
