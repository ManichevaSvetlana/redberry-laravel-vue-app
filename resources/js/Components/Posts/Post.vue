<template>
    <div class="flex flex-col items-left p-10">
        <a href="#" @click="modalRead = true">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ post.body ? post.body.substring(0, 50)  : ''}}...</p>
        <div class="flex mt-4 space-x-3 md:mt-6" v-if="post.user_id == user.id">
            <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" @click="deletePost(post); $emit('delete')">Delete</a>
            <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" @click="modalEdit = true">Edit</a>
        </div>
    </div>

    <ViewPost :post="post" :visible="modalRead" @close="modalRead = false"></ViewPost>
    <EditPost :post="post" :visible="modalEdit" @close="modalEdit = false" @update="$emit('update'); modalEdit = false"></EditPost>
</template>

<script setup>
import ViewPost from './ViewPost';
import EditPost from './EditPost';
import {ref} from "vue";
import usePosts from "../../composable/posts";

const props = defineProps({
    user: Object,
    post: Object
})
const { deletePost } = usePosts()
const emits = defineEmits(['update', 'delete'])
const modalRead = ref(false)
const modalEdit = ref(false)
</script>

<style scoped>

</style>
