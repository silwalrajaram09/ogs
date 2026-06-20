<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import PostForm from './partials/PostForm.vue';

defineOptions({ layout: AdminLayout });
</script>

<template>
    <Head title="New Post" />

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">New post</h1>
        <p class="text-sm text-gray-500 mt-1">Write and publish an announcement, news item, or blog post.</p>
    </div>

    <PostForm />
</template>