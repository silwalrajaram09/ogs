<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

interface Page {
    id: number;
    title: string;
    slug: string;
    updated_at: string;
}

defineProps<{ pages: { data: Page[]; links: any[] } }>();

function destroy(page: Page) {
    if (!confirm(`Delete the "${page.title}" page? This cannot be undone.`)){

        return;
    }

    router.delete(route('pages.destroy', page.id));
}
</script>

<template>
    <Head title="Pages" />

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Pages</h1>
            <p class="mt-1 text-sm text-gray-500">
                Public content pages like About, Mission, Vision, Contact.
            </p>
        </div>
        <Link
            :href="route('pages.create')"
            class="inline-flex items-center gap-2 rounded-lg bg-violet-600 px-4 py-2 text-sm text-white transition-colors hover:bg-violet-700"
        >
            + New page
        </Link>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-100 bg-white">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th
                        class="px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase"
                    >
                        Title
                    </th>
                    <th
                        class="w-56 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase"
                    >
                        Public URL
                    </th>
                    <th
                        class="w-32 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase"
                    >
                        Last updated
                    </th>
                    <th
                        class="w-24 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase"
                    >
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <tr
                    v-for="page in pages.data"
                    :key="page.id"
                    class="transition-colors hover:bg-gray-50"
                >
                    <td class="px-4 py-3 font-medium text-gray-900">
                        {{ page.title }}
                    </td>
                    <td class="px-4 py-3 font-mono text-xs text-gray-500">
                        /{{ page.slug }}
                    </td>
                    <td class="px-4 py-3 text-gray-500">
                        {{ page.updated_at }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <Link
                                :href="route('pages.edit', page.id)"
                                class="rounded-md border border-gray-200 px-2 py-1 text-xs text-gray-500 transition-colors hover:bg-gray-50 hover:text-gray-900"
                            >
                                Edit
                            </Link>
                            <button
                                @click="destroy(page)"
                                class="rounded-md border border-gray-200 px-2 py-1 text-xs text-gray-400 transition-colors hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
