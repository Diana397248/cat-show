<script setup>
import {Head, Link} from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import CheckCircle from 'vue-material-design-icons/CheckCircle.vue'
import RecommendedVideos from '@/Components/RecommendedVideos.vue';
import AddComment from '@/Components/AddComment.vue';
import AvatarCharacter from '@/Components/AvatarCharacter.vue';
import {onMounted, ref} from "vue";
import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue'
import ThumbDownOutline from 'vue-material-design-icons/ThumbDownOutline.vue'

const props = defineProps({
    auth: Object,
    video: Object,
    recommendedVideos: Array
})

const comments = ref([])

const dislikeBtnClick = () => {
    if (props.auth.user) {
        fetch(`/clips/${props.video.id}/dislike`, {method: "POST"})
            .then(res => res.json())
            .then(json => props.video.dislikes = json)
    }
}

const likeBtnClick = () => {
    if (props.auth.user) {
        fetch(`/clips/${props.video.id}/like`, {method: "POST"})
            .then(res => res.json())
            .then(json => props.video.likes = json)
    }

}

const updateComments = () => {
    fetch(`/comments?id=${props.video.id}`)
        .then(res => res.json())
        .then(json => comments.value = json)
}
onMounted(() => {
    updateComments()
})

</script>

<template>

    <Head title="CatShow"/>

    <NavLayout>
        <div class="xl:flex">
            <div class="p-3">
                <video @mouseover="show = true" :src="video.video || ''" controls autoplay/>
                <div class="text-white text-2xl font-extrabold mt-4">{{ video.title }}</div>
                <div class="flex items-center mb-4">
                    <AvatarCharacter :name="video.user"/>
                    <div class="pl-2 mt-1">
                        <div class="text-white text-lg font-extrabold flex items-center">
                            {{ video.user }}
                            <CheckCircle class="pl-2" fillColor="#888888" :size="17"/>
                        </div>
                        <!--                        <div class="text-gray-400 text-sm font-extrabold">{{ video.views }}</div>-->
                        <div class="text-gray-400 text-sm font-extrabold">{{ video.created_time }}</div>
                    </div>
                </div>

                <!-- Videos suggested MOBILE VIEW -->
                <div class="w-[500px] p-3 block sm:hidden">
                    <div v-for="vid in recommendedVideos" :key="vid">
                        <Link class="flex mb-3" :href="route('clips.show', { id: vid.id })">
                            <RecommendedVideos :vid="vid"/>
                        </Link>
                    </div>
                </div>
                <!-- Videos suggested MOBILE VIEW End -->

                <div class="bg-[#3F3F3F] rounded-lg w-full p-3 text-white">
                    <!--                    <div class="text-white text-lg font-extrabold">{{ video.views }}</div>-->
                    <div class="flex justify-between">
                        <div class="pl-2 text-white text-lg font-extrabold">{{ video.created_time }}</div>
                        <div class="pr-12 mt-4 flex items-center">
                            <ThumbUpOutline @click="likeBtnClick" fillColor="#FFFFFF" :size="20" class="pr-2"
                                            :class="{'hover:scale-125': $page.props.auth.user}"/>
                            <div class="text-gray-400 text-sm font-extrabold pr-10">{{ video.likes }}</div>

                            <ThumbDownOutline @click="dislikeBtnClick" fillColor="#FFFFFF" :size="20" class="pr-2"
                                              :class="{'hover:scale-125': $page.props.auth.user}"/>
                            <div class="text-gray-400 text-sm font-extrabold pr-10">{{ video.dislikes }}</div>
                        </div>
                    </div>

                    <div class="text-sm font-extrabold mb-6"></div>
                    <div class="text-sm font-extrabold" style="width:1300px;">
                        {{ video.description }}
                    </div>
                </div>


                <AddComment v-if="$page.props.auth.user" :id="video.id" :updateComments="updateComments"/>

                <div class="mt-6">
                    <div class="text-white text-lg font-extrabold">{{ comments.length }} Comments</div>
                    <div v-for="comment in comments" :key="comment">
                        <div class="flex items-flex mb-4 mt-2">
                            <AvatarCharacter :name="comment.user.name"/>
                            <div class="pl-6 mt-1">
                                <div class="text-white font-extrabold flex items-baseline">
                                    <div>{{ comment.user.name }}</div>
                                    <div class="text-gray-400 pl-3">{{ comment.time }}</div>
                                </div>
                                <div class="text-gray-200 text-sm font-extrabold">
                                    {{ comment.text }}
                                </div>
                                <div class="text-gray-200 text-sm font-extrabold">
                                    {{ comment.updated_time }}
                                </div>
                                <!--                                Лайки -->
                                <!--                                <div class="mt-4 flex items-center">-->
                                <!--                                    <ThumbUpOutline fillColor="#FFFFFF" :size="20" class="pr-2"/>-->
                                <!--                                    <div class="text-gray-400 text-sm font-extrabold pr-10">{{ (Math.random() * 100).toFixed(0) }}</div>-->
                                <!--                                    <ThumbDownOutline fillColor="#FFFFFF" :size="20"/>-->
                                <!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Videos suggested Larger VIEW -->
            <div class="w-[500px] p-3 sm:block hidden">
                <div v-for="vid in recommendedVideos" :key="vid">
                    <Link class="flex mb-3" :href="route('clips.show', { id: vid.id })">
                        <RecommendedVideos :vid="vid"/>
                    </Link>
                </div>
            </div>
            <!-- Videos suggested Larger VIEW End -->
        </div>
    </NavLayout>
</template>
