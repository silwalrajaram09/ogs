<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import PostForm from './partials/PostForm.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    post: {
        id: number;
        title: string;
        slug: string;
        type: 'announcement' | 'news' | 'blog';
        body: string;
        is_published: boolean;
    };
}>();
</script>

<template>
    <Head :title="`Edit: ${post.title}`" />

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit post</h1>
        <p class="text-sm text-gray-500 mt-1">{{ post.title }}</p>
    </div>

    <PostForm :post="post" />
</template>