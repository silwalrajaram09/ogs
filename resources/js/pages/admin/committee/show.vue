<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    committee: any;
}>();
</script>

<template>
    <Head title="Committee Details" />

    <div class="p-5">
        <div class="mb-5 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Committee Details</h1>

            <Link
                href="/admin/committees"
                class="rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
            >
                Back to Committees
            </Link>
        </div>

        <div class="space-y-3 rounded border p-5">
            <div>
                <strong>Name:</strong>
                {{ committee.name }}
            </div>

            <div>
                <strong>Parent Committee:</strong>
                {{ committee.parent?.name ?? 'No Parent (Root Committee)' }}
            </div>

            <div v-if="committee.children && committee.children.length > 0">
                <strong>Sub-Committees:</strong>
                <ul class="mt-2 list-inside list-disc">
                    <li v-for="child in committee.children" :key="child.id">
                        {{ child.name }}
                    </li>
                </ul>
            </div>

            <div v-if="committee.user">
                <strong>Created By:</strong>
                {{ committee.user.name }}
            </div>

            <div v-if="committee.updater">
                <strong>Last Updated By:</strong>
                {{ committee.updater.name }}
            </div>
        </div>
    </div>
</template>
