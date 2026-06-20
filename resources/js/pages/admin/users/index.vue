<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch, onUnmounted } from 'vue';
import { route } from 'ziggy-js';
import AdminLayout from '@/layouts/AdminLayout.vue';
import debounce from 'lodash/debounce';

defineOptions({ layout: AdminLayout });

interface User {
    id: number;
    full_name: string;
    email: string;
    type: string;
    member_type: string;
    is_active: boolean;
    committees_count: number;
    programs_count: number;
    photo_path?: string | null;
}

const props = defineProps<{
    users: {
        data: User[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        from: number;
        to: number;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    filters?: {
        search?: string;
        per_page?: number | string;
    };
}>();

const search = ref(props.filters?.search || '');
const perPage = ref(Number(props.filters?.per_page) || 10);

function cleanLabel(label: string) {
    return label.replace('&laquo;', '«').replace('&raquo;', '»');
}

const debouncedSearch = debounce((value: string) => {
    router.get(
        route('users.index'),
        {
            search: value || undefined,
            per_page: perPage.value,
            page: 1,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        },
    );
}, 300);

watch(search, (newValue) => {
    debouncedSearch(newValue);
});

watch(perPage, (newValue) => {
    router.get(
        route('users.index'),
        {
            search: search.value || undefined,
            per_page: newValue,
            page: 1,
        },
        {
            preserveState: true,
            preserveScroll: true,
        },
    );
});

onUnmounted(() => {
    debouncedSearch.cancel();
});

function goToPage(url: string | null) {
    if (!url) return;

    router.visit(url, {
        preserveScroll: true,
    });
}

function destroy(id: number) {
    if (!confirm('Delete this user? This cannot be undone.')) {
        return;
    }

    router.delete(route('users.destroy', id), {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Users" />

    <div class="flex flex-col gap-6 p-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <p
                    class="mb-1 text-xs font-semibold tracking-widest text-gray-400 uppercase"
                >
                    Admin
                </p>

                <h1
                    class="text-2xl font-semibold text-gray-900 dark:text-white"
                >
                    Users
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <select
                    v-model="perPage"
                    class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-gray-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                >
                    <option :value="10">10 per page</option>
                    <option :value="25">25 per page</option>
                    <option :value="50">50 per page</option>
                    <option :value="100">100 per page</option>
                </select>

                <Link
                    :href="route('users.create')"
                    class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition-opacity hover:opacity-80 dark:bg-white dark:text-gray-900"
                >
                    + New User
                </Link>
            </div>
        </div>

        <!-- Search -->
        <input
            v-model="search"
            type="text"
            placeholder="Search by name or email..."
            class="w-full max-w-sm rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:focus:ring-gray-600"
        />

        <!-- Table -->
        <div
            class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-800"
        >
            <table class="w-full text-sm">
                <thead
                    class="bg-gray-50 text-xs font-semibold tracking-widest text-gray-400 uppercase dark:bg-gray-900"
                >
                    <tr>
                        <th class="px-5 py-3 text-left">User</th>
                        <th class="px-5 py-3 text-left">Type</th>
                        <th class="px-5 py-3 text-center">Committees</th>
                        <th class="px-5 py-3 text-center">Programs</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody
                    class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-950"
                >
                    <tr v-if="users.data.length === 0">
                        <td
                            colspan="6"
                            class="px-5 py-10 text-center text-gray-400"
                        >
                            No users found.
                        </td>
                    </tr>

                    <tr
                        v-for="user in users.data"
                        :key="user.id"
                        class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-900"
                    >
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <template v-if="user.photo_path">
                                    <img
                                        :src="user.photo_path"
                                        :alt="user.full_name"
                                        class="h-8 w-8 rounded-lg object-cover"
                                    />
                                </template>

                                <template v-else>
                                    <div
                                        class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-gray-900 text-xs font-semibold text-white dark:bg-white dark:text-gray-900"
                                    >
                                        {{
                                            user.full_name?.[0]?.toUpperCase() ||
                                            '?'
                                        }}
                                    </div>
                                </template>

                                <div>
                                    <p
                                        class="font-medium text-gray-900 dark:text-white"
                                    >
                                        {{ user.full_name }}
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        {{ user.email }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-3">
                            <span
                                class="text-xs font-medium text-gray-500 capitalize dark:text-gray-400"
                            >
                                {{ user.member_type || user.type }}
                            </span>
                        </td>

                        <td class="px-5 py-3 text-center">
                            <span
                                class="text-xs font-semibold text-gray-700 dark:text-gray-300"
                            >
                                {{ user.committees_count }}
                            </span>
                        </td>

                        <td class="px-5 py-3 text-center">
                            <span
                                class="text-xs font-semibold text-gray-700 dark:text-gray-300"
                            >
                                {{ user.programs_count }}
                            </span>
                        </td>

                        <td class="px-5 py-3 text-center">
                            <span
                                class="rounded-full px-2.5 py-1 text-xs font-medium"
                                :class="
                                    user.is_active
                                        ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                        : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400'
                                "
                            >
                                {{ user.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <Link
                                    :href="route('users.show', user.id)"
                                    class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs text-gray-600 transition-colors hover:border-gray-400 dark:border-gray-700 dark:text-gray-300"
                                >
                                    View
                                </Link>

                                <Link
                                    :href="route('users.edit', user.id)"
                                    class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs text-gray-600 transition-colors hover:border-gray-400 dark:border-gray-700 dark:text-gray-300"
                                >
                                    Edit
                                </Link>

                                <button
                                    @click="destroy(user.id)"
                                    class="rounded-lg border border-red-100 px-3 py-1.5 text-xs text-red-500 transition-colors hover:border-red-300 dark:border-red-900"
                                >
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between">
            <p class="text-xs text-gray-400">
                Showing {{ users.from || 0 }} to {{ users.to || 0 }} of
                {{ users.total || 0 }} users
            </p>

            <div class="flex items-center gap-1">
                <button
                    v-for="link in users.links"
                    :key="link.label"
                    @click="goToPage(link.url)"
                    :disabled="!link.url || link.active"
                    class="rounded-lg border px-3 py-1 text-sm transition-colors"
                    :class="{
                        'bg-gray-900 text-white dark:bg-white dark:text-gray-900':
                            link.active,

                        'border-gray-200 text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800':
                            !link.active && link.url,

                        'cursor-not-allowed border-gray-100 text-gray-300 dark:border-gray-800 dark:text-gray-600':
                            !link.url,
                    }"
                >
                    {{ cleanLabel(link.label) }}
                </button>
            </div>
        </div>
    </div>
</template>
