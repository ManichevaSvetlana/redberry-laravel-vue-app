<template>
    <Modal :visible="visible" @close="$emit('close')">
        <div class="py-6 px-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Post: {{ post.id }}</h3>
            <div class="space-y-6">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                    <input v-model="post.title" type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Body</label>
                    <textarea v-model="post.body" name="body" id="body" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required></textarea>
                </div>
                <button class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="updatePost(post); $emit('update', post)">Update</button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from '../../Components/Modal';
import { ref } from 'vue';
import usePosts from "../../composable/posts";

const props = defineProps({
    visible: Boolean,
    post: Object
})
const emits = defineEmits(['close', 'update'])
const { updatePost } = usePosts()
</script>

<style scoped>

</style>
