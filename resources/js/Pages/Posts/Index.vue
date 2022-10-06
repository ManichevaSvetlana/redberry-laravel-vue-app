<template>
    <Head title="Posts" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>


        <div class="py-12 px-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <CreatePost @create="getPosts"></CreatePost>
                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 gap-4 py-3">
                    <div class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700" v-for="post in posts">
                        <Post :post="post" :user="user" @update="getPosts" @delete="getPosts"></Post>
                    </div>
                </div>
            </div>
        </div>


    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import CreatePost from '../../Components/Posts/CreatePost';
import Post from '../../Components/Posts/Post';
import { Head } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
import usePosts from "../../composable/posts";

const props = defineProps({
    user: Object
})
const { posts, getPosts } = usePosts()

onMounted(getPosts)
</script>
