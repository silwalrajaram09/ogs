<!-- <script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Pages', href: '/admin/pages' },
            { title: 'Edit', href: '/admin/pages/edit' },
        ],
    },
});
</script>

<template>
    <Head title="Edit Page" />
    <div class="p-4">Page edit page is under construction.</div>
</template> -->
<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import PageForm from './partials/PageForm.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    page: { id: number; title: string; slug: string; description : string };
}>();
</script>

<template>
    <Head :title="`Edit: ${page.title}`" />
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit page</h1>
        <p class="text-sm text-gray-500 mt-1">{{ page.title }}</p>
    </div>
    <PageForm :page="page" />
</template>