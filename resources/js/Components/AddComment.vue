<template>
    <div class="mt-6 text-white">

        <form @submit.prevent="addComment">
            <div>
                <input
                    v-model="text"
                    type="text"
                    class="
                        form-control
                        block
                        w-full
                        px-5
                        py-1.5
                        text-xl
                        font-normal
                        text-gray-200
                        bg-black
                        placeholder-gray-400
                        bg-clip-padding
                        border
                        border-solid
                        border-gray-600
                        rounded
                        transition
                        ease-in-out
                        m-0
                        border-transparent
                        focus:ring-0
                    "
                    placeholder="Введите комментарий"
                />
                <!--                <span v-if="error.title" class="text-red-500">{{ error.title }}</span>-->
            </div>

            <div class="my-5"></div>
            <div class="float-right">
                <button
                    type="submit"
                    class="text-white bg-green-600 hover:bg-green-700 font-bold py-2 px-4 rounded cursor-pointer"
                >
                    Отправить
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>

import {defineProps, ref, toRefs} from 'vue';
import {router} from "@inertiajs/vue3";

const props = defineProps({id: String, updateComments: Function})

let text = ref('')
// let error = ref({
//     text: null,
//
// })


const addComment = () => {
    let err = false
    // error.value.text = null

    console.log(props.id)
    // if (!text.value) {
    //     error.value.text = 'Please enter a text';
    //     err = true
    // }
    //
    // if (err) {
    //     return
    // }

    let data = new FormData()

    data.append('text', text.value)
    data.append('video_id', props.id)

    fetch('/comments', {
        method: "POST",
        body: data
    })
        .then(() => {
            props.updateComments()
        })


}


</script>

<style lang="scss" scoped>

</style>
