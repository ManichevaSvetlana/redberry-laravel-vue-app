<template>
    <Modal :visible="visible" @close="$emit('close')">
        <div class="py-6 px-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ post.title }}</h3>
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    {{ post.body }}
                </p>
            </div>
            <div>
                <div class="max-w-lg mb-8">
                    <div class="w-full p-4">
                        <div class="mb-2">
                            <label for="comment" class="text-lg text-gray-600">Add a comment</label>
                            <textarea class="w-full h-20 p-2 border rounded focus:outline-none focus:ring-gray-300 focus:ring-1"
                                      name="comment" placeholder="" v-model="comment.message"></textarea>
                        </div>
                        <button class="px-3 py-2 text-sm text-blue-100 bg-blue-600 rounded" @click="createComment">Comment</button>
                    </div>
                </div>

                <div v-if="comments">
                    <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg" v-for="comment in comments">
                        <div class="relative flex gap-4">
                            <div class="flex flex-col w-full">
                                <div class="flex flex-row justify-between">
                                    <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{ comment.user.name }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="-mt-4 text-gray-500">{{ comment.message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import usePosts from "../../composable/posts";
import Modal from '../../Components/Modal';

const props = defineProps({
    post: Object,
    visible: Boolean
})
const emits = defineEmits(['close'])
const { comments, getComments, storeComment } = usePosts()
const modalEdit = ref(false)
const comment = ref({post_id: props.post.id, message: ''})

function getCommentsForPost()
{
    getComments(props.post.id)
}

function createComment()
{
    storeComment(comment)
    getComments(props.post.id)
}

onMounted(getCommentsForPost)


</script>

<style scoped>

</style>
