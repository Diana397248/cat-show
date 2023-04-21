<template>
    <div :style="{backgroundColor: stringToColour(name)}"
         class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-600">
        <p class="text-4xl text-black">{{ name.substring(0, 1).toUpperCase() }}</p>
        <!--        {{name}}-->
    </div>
</template>

<script setup>
import {defineProps, ref} from "vue";

defineProps({name: String})

const stringToColour = (str) => {
    var hash = 0;
    for (var i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash);
    }
    var colour = '#';
    for (var i = 0; i < 3; i++) {
        var value = (hash >> (i * 8)) & 0xFF;
        colour += ('00' + value.toString(16)).substr(-2);
    }
    return colour;
}
</script>

<style scoped>

</style>
