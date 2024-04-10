<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <header class="header">
        <div class="container header__container">
            <Link :href="route('sections.index')">Forum</Link>
        </div>
    </header>
</template>

<style lang="scss" scoped>
@import "../../scss/vars/colors";
@import "../../scss/func/rem-calc";

.header {
    color: $white;
    padding: rem-calc(20 0);
    background: $primary-color;
}
</style>
