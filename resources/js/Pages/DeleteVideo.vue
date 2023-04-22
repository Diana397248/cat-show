<script setup>
import {Head, Link} from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';

defineProps({videos: Array})

const restrictionsToStr = (restriction) => {
    if (restriction === "AVAILABLE") return "нет"
    else if (restriction === 'VIOLATION') return "нарушение"
    else if (restriction === 'SHADOW_BAN') return "теневой бан"
    else if (restriction === 'BAN') return "забанено"
    return "нет"
}
</script>

<template>

    <Head title="Cat show"/>

    <NavLayout>
        <div class="max-w-2xl mx-auto p-4">
            <table class="min-w-full">
                <thead class="border-b">
                <tr class="text-white flex justify-between">
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Video</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Option</th>
                </tr>
                </thead>
                <tbody>
                <div v-for="video in videos" :key="video">
                    <tr class="border-b flex justify-between">
                        <td class="px-6 py-4 w-7/12 text-sm font-medium text-gray-900">
                            <video width="320" :src="video.video || ''" type="video/mp4" controls/>
                        </td>
                        <td class="px-6 py-4 w-5/12 text-sm font-medium text-gray-900 relative">
                            <div class="text-white font-extrabold mb-4">Название: {{ video.title }}</div>
                            <div class="text-white font-extrabold mb-4">
                                Ограничение: {{ restrictionsToStr(video.restrictions) }}
                            </div>
                            <template v-if="$page.props.auth.user&&$page.props.auth.user.name==='admin'">
                                <form action="/restriction" method="post">
                                    <div>
                                        <div class="text-gray-200">Ограничение</div>
                                        <label for="underline_select" class="sr-only">Ограничение</label>
                                        <input type="hidden" id="video_id" name="video_id" :value="video.id"/>
                                        <select
                                            id="underline_select"
                                            name="restriction"
                                            required
                                            class="
                            form-control
                            w-full
                            px-5
                            py-1.5
                            text-xl
                            font-normal
                            text-black-200
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
                            appearance-none
                           focus:outline-none
                           focus:ring-0
                           focus:border-gray-200
                            peer ">
                                            <option
                                                value="AVAILABLE"
                                                :selected="video.restrictions==='AVAILABLE'"
                                            >
                                                Нет ограничений
                                            </option>
                                            <option
                                                :selected="video.restrictions==='VIOLATION'"
                                                value="VIOLATION"
                                            >
                                                Нарушение
                                            </option>
                                            <option
                                                :selected="video.restrictions==='SHADOW_BAN'"
                                                value="SHADOW_BAN"
                                            >
                                                Теневой бан
                                            </option>
                                            <option
                                                :selected="video.restrictions==='BAN'"
                                                value="BAN"
                                            >
                                                Бан
                                            </option>
                                        </select>
                                    </div>
                                    <div class="flex justify-center py-8">
                                        <button
                                            type="submit"
                                            class="text-white mb-10 bg-green-600 hover:bg-green-700 font-bold py-3 px-5 rounded cursor-pointer"
                                        >
                                            Изменить
                                        </button>
                                    </div>
                                </form>
                            </template>
                            <div class="w-full">
                                <Link
                                    as="button"
                                    method="delete"
                                    :href="route('clips.destroy', { id: video.id })"
                                    class="text-white absolute bottom-4 right-4 text-xs bg-red-600 hover:bg-red-700 font-bold py-1 px-1 float-right rounded cursor-pointer"
                                >
                                    Delete
                                </Link>
                            </div>
                        </td>
                    </tr>
                </div>
                </tbody>
            </table>
        </div>
    </NavLayout>
</template>
