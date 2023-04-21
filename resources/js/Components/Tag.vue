<template>
    <div
        class="
        cursor-pointer
         inline-flex
          items-center
           font-bold
           leading-sm
           uppercase
            bg-blue-200
             rounded-full
             text-black
"
        :style="{backgroundColor: getColor(text)}"
        :class="{ 'text-xs px-1 py-1': size==='xs',
         'text-xl px-3 py-1': size==='xl'}"
    >
        {{ text }}
    </div>
</template>

<script setup>
import {defineProps} from "vue";

defineProps({
    text: String,
    size: String,
})

const getColor = (text) => {
    if (text === 'Веселые')
        return "rgba(191,219,254,0.69)"
    else if (text === 'Милые')
        return "rgba(99,102,241,0.76)"
    else if (text === 'Все')
        return "rgba(163,230,53,0.7)"
    else
        return "rgba(251,191,36,0.68)"
}
</script>

<style scoped>

</style>
