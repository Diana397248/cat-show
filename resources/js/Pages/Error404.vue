<script setup>
import {Head, Link} from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import VideoCard from '@/Components/VideoCard.vue';

</script>

<template>
    <Head title="CatShow"/>
    <div class="error_404 bg-white" style="height:100vh;">
        <a href="/">
            <img src="images/404img.png">
        </a>
        <h1>404</h1>
        <h2>Страница не найдена</h2>
        <p>Страница, которую вы ищете, была удалена или не существует</p>
    </div>

</template>

<style>
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 500px;
    height: 500px;
}

h1 {
    font-size: 150px;
    font-weight: 700;
    text-align: center;
}

h2 {
    font-size: 62px;
    font-weight: 500;
    text-align: center;
}

p {
    font-size: 30px;
    font-weight: 300;
    text-align: center;
}

</style>
