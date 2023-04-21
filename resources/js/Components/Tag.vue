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
        return "rgb(191 219 254)"
    else if (text === 'Милые')
        return "rgb(99 102 241)"
    else if (text === 'Все')
        return "rgb(163 230 53)"
    else
        return "rgb(251 191 36)"
}
</script>

<style scoped>

</style>
