<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <header class="header">
        <div class="container header__container">
            <nav>
                <ul>
                    <li><Link :href="route('sections.index')">Forum</Link></li>
                    <li><Link :href="route('users.personal')">Profile</Link></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<style lang="scss" scoped>
@import "../../scss/vars/colors";
@import "../../scss/func/rem-calc";

ul {
    padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
    gap: rem-calc(10);
}

.header {
    color: $white;
    padding: rem-calc(20 0);
    background: $primary-color;
}
</style>
