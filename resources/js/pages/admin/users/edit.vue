<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Users', href: '/admin/users' },
            { title: 'Edit', href: '/admin/users/edit' },
        ],
    },
});
</script>

<template>
    <Head title="Edit User" />
    <div class="p-4">User edit page is under construction.</div>
</template>
