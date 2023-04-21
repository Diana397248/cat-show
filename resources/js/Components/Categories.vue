<template>
    <div class="flex justify-between px-96 py-12">

        <Link :href="route('home')">
            <Tag size="xl" text="Все"/>
        </Link>
        <Link :href="route('categories', { category:'Милые' })">
            <Tag size="xl" text="Милые"/>
        </Link>
        <Link :href="route('categories', { category:'non-category' })">
            <Tag color="rgb(99 102 241)" size="xl" text="Без категории"/>
        </Link>
        <Link :href="route('categories', { category:'Веселые' })">
            <Tag color="rgb(251 191 36)" size="xl" text="Веселые"/>
        </Link>
    </div>
</template>

<script setup>
import Tag from '@/Components/Tag.vue';
import {Link} from '@inertiajs/vue3';

</script>

<style scoped>

</style>
