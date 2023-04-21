<script setup>
import {ref} from 'vue'
import {Head, router} from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';

defineProps({errors: Object})

let title = ref('')
let description = ref('')
let image = ref('')
let video = ref('')
let error = ref({
    title: null,
    image: null,
    video: null,
    description: null,
})

const addVideo = () => {
    let err = false

    error.value.title = null
    error.value.image = null
    error.value.video = null
    error.value.description = null

    if (!title.value) {
        error.value.title = 'Please enter a title';
        err = true
    }
    if (!image.value) {
        error.value.image = 'Please select a thumbnail';
        err = true
    }
    if (!video.value) {
        error.value.video = 'Please select a video';
        err = true
    }

    if (err) {
        return
    }

    let data = new FormData()

    data.append('title', title.value)
    data.append('image', image.value)
    data.append('video', video.value)
    data.append('description', description.value)

    router.post('/clips', data)

}

const getVideo = (e) => video.value = e.target.files[0]
const getImage = (e) => image.value = e.target.files[0]
</script>

<template>

    <Head title="Youtube"/>

    <NavLayout>
        <div class="max-w-xl mx-auto px-4  ">
            <div class="text-white font-extrabold text-3xl py-10 text-center">Add Video</div>
            <form @submit.prevent="addVideo" class="add-video-form block">
                <div>
                    <div class="text-gray-200">Title</div>
                    <input
                        v-model="title"
                        type="text"
                        class="
                        form-control
                        block
                        w-full
                        px-5
                        py-1.5
                        text-xl
                        font-normal
                        text-black-200
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
                        placeholder="Мой любимый кот"
                    />
                    <span v-if="error.title" class="text-red-500">{{ error.title }}</span>
                </div>

                <div>
                    <div class="text-gray-200">Description</div>
                    <textarea
                        rows="4"
                        v-model="description"
                        type="text"
                        class="
                        form-control
                        block
                        w-full
                        px-5
                        py-1.5
                        text-xl
                        font-normal
                        text-black-200
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
                        placeholder="Описание видео"
                    />
                    <span v-if="error.description" class="text-red-500">{{ error.description }}</span>
                </div>

                <div class="my-5"></div>

                <div>
                    <div class="flex justify-center">
                        <div class="w-full">
                            <div class="text-gray-200">Thumbnail</div>
                            <input
                                @change="getImage"
                                class="
                                form-control
                                block
                                w-full
                                px-3
                                py-1.5
                                border
                                text-white
                                border-solid
                                border-gray-600
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700
                                focus:border-blue-600
                                focus:outline-none
                            "
                                type="file"
                                id="formImg"
                            >
                        </div>
                    </div>
                    <span v-if="error.image" class="text-red-500">{{ error.image }}</span>
                    <span v-if="errors && errors.image" class="text-red-500">{{ errors.image }}</span>
                </div>

                <div class="my-5"></div>

                <div>
                    <div class="flex justify-center">
                        <div class="w-full">
                            <div class="text-gray-200">Video/MP4</div>
                            <input
                                @change="getVideo"
                                class="
                                form-control
                                block
                                w-full
                                px-3
                                py-1.5
                                border
                                text-white
                                border-solid
                                border-gray-600
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700
                                focus:border-blue-600
                                focus:outline-none
                            "
                                type="file"
                                id="formFile"
                            >
                            <span v-if="error.video" class="text-red-500">{{ error.video }}</span>
                            <span v-if="errors && errors.video" class="text-red-500">{{ errors.video }}</span>
                        </div>
                    </div>
                </div>

                <div class="my-5"></div>

                <div class="flex justify-center py-8">
                    <button
                        type="submit"
                        class="text-white mb-10 bg-green-600 hover:bg-green-700 font-bold py-3 px-5 rounded cursor-pointer"
                    >
                        Загрузить видео
                    </button>
                </div>
            </form>
        </div>
    </NavLayout>
</template>
<style>
.add-video-form {
    background: rgba(217, 217, 217, 0.8);
    border-radius: 40px;
    padding: 30px 30px 0 30px;
}

/* Add padding to containers */
.form-container {
    padding: 16px;
    width: 100%;
}

.form-container h1 {
    font-size: 40px;
    font-weight: 600;
}

h1 {
    font-size: 50px;
    font-weight: 700;
    text-align: center;
}


/* Full-width input fields */
.add-video-form input[type=text],
.add-video-form textarea[type=text],
.add-video-form input[type=email],
.add-video-form input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

.add-video-form input[type=text]:focus,
.add-video-form textarea[type=text]:focus,
.add-video-form input[type=email]:focus,
.add-video-form input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
    display: block;
    background-color: #658DCB;
    color: white;
    padding: 10px 20px;
    margin: 0 auto;
    border: none;
    cursor: pointer;
    width: 30%;
    opacity: 0.9;
    border-radius: 30px;

}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}
</style>
