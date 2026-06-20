<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import PageForm from './partials/PageForm.vue';

defineOptions({ layout: AdminLayout });
</script>

<template>
    <Head title="New Page" />
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">New page</h1>
        <p class="text-sm text-gray-500 mt-1">Add a public page like About, Mission, or Vision.</p>
    </div>
    <PageForm />
</template>