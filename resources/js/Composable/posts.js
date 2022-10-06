import { ref } from 'vue';
import axios from 'axios';

export default function usePosts() {
    const posts = ref([])
    const errors = ref('')
    const comments = ref([])

    const getPosts = async () => {
        let response = await axios.get('/posts-get')
        posts.value = response.data
    }

    const storePost = async (data) => {
        errors.value = ''
        try {
            await axios.post('/posts', data)
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updatePost = async (post) => {
        errors.value = ''
        try {
            await axios.patch(`/posts/${post.id}`, post)
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const deletePost = async (post) => {
        errors.value = ''
        try {
            await axios.delete(`/posts/${post.id}`)
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const storeComment = async (data) => {
        errors.value = ''
        try {
            await axios.post('/comments', data)
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const getComments = async (id) => {
        let response = await axios.get('/comments?post_id=' + id)
        comments.value = response.data
    }

    return {
        errors,
        posts,
        comments,
        getPosts,
        storePost,
        updatePost,
        storeComment,
        getComments,
        deletePost
    }
}
