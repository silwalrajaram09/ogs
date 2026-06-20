<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: dashboard() }],
    },
});

const props = defineProps<{
    auth_user: {
        full_name: string;
        email: string;
        type: string;
    };
    stats: {
        total_committees: number;
        total_programs: number;
        total_posts: number;
        total_users: number;
    };
}>();

const statCards = computed(() => [
    {
        label: 'My Committees',
        value: props.stats.total_committees,
    },
    {
        label: 'My Programs',
        value: props.stats.total_programs,
    },
    {
        label: 'Total Posts',
        value: props.stats.total_posts,
    },
    {
        label: 'Total Users',
        value: props.stats.total_users,
    },
]);
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex flex-col gap-8 p-6">
        <!-- Welcome -->
        <div class="flex items-center justify-between">
            <div>
                <p
                    class="mb-1 text-xs font-semibold tracking-widest text-gray-400 uppercase"
                >
                    Dashboard
                </p>

                <h1
                    class="text-2xl font-semibold text-gray-900 dark:text-white"
                >
                    Welcome back, {{ auth_user.full_name }}
                </h1>

                <p class="mt-0.5 text-sm text-gray-400">
                    {{ auth_user.email }}
                </p>
            </div>

            <span
                class="rounded-full bg-gray-900 px-3 py-1 text-xs font-medium text-white capitalize dark:bg-white dark:text-gray-900"
            >
                {{ auth_user.type }}
            </span>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div
                v-for="stat in statCards"
                :key="stat.label"
                class="rounded-xl border border-gray-100 bg-white p-5 dark:border-gray-800 dark:bg-gray-900"
            >
                <p
                    class="text-xs font-medium tracking-widest text-gray-400 uppercase"
                >
                    {{ stat.label }}
                </p>

                <p
                    class="mt-2 text-3xl font-semibold text-gray-900 dark:text-white"
                >
                    {{ stat.value }}
                </p>
            </div>
        </div>

        <!-- Quick Access -->
        <div>
            <p
                class="mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase"
            >
                Quick Access
            </p>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <Link
                    href="/my-committees"
                    class="group flex items-center justify-between rounded-xl border border-gray-100 bg-white px-5 py-4 transition-colors hover:border-gray-300 dark:border-gray-800 dark:bg-gray-900 dark:hover:border-gray-600"
                >
                    <div>
                        <p
                            class="text-sm font-semibold text-gray-900 dark:text-white"
                        >
                            My Committees
                        </p>

                        <p class="mt-0.5 text-xs text-gray-400">
                            {{ stats.total_committees }} assigned
                        </p>
                    </div>

                    <svg
                        class="h-4 w-4 text-gray-300 transition-colors group-hover:text-gray-600 dark:group-hover:text-gray-300"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </Link>

                <Link
                    href="/my-programs"
                    class="group flex items-center justify-between rounded-xl border border-gray-100 bg-white px-5 py-4 transition-colors hover:border-gray-300 dark:border-gray-800 dark:bg-gray-900 dark:hover:border-gray-600"
                >
                    <div>
                        <p
                            class="text-sm font-semibold text-gray-900 dark:text-white"
                        >
                            My Programs
                        </p>

                        <p class="mt-0.5 text-xs text-gray-400">
                            {{ stats.total_programs }} enrolled
                        </p>
                    </div>

                    <svg
                        class="h-4 w-4 text-gray-300 transition-colors group-hover:text-gray-600 dark:group-hover:text-gray-300"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </Link>
            </div>
        </div>
    </div>
</template>
