<script setup lang="ts">

import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

defineOptions({ 
    breadcrumbs: [
        {
            title: 'My Programs',
            href: '/my-programs',
        },
    ],
});


interface Program {
    id: number;
    name: string;
    description: string | null;
   created_at: string; // ISO date string from user_programs.created_at
    members_count?: number; // optional — add to controller query if you want it
}

const props = defineProps<{
    programs: Program[];
}>();

function formatDate(dateStr: string): string {
    return new Date(dateStr).toLocaleDateString('en-US', {
        month: 'long',
        year: 'numeric',
    });
}

const count = computed(() => props.programs.length);
const label = computed(() => (count.value === 1 ? 'program' : 'programs'));
</script>

<template>
    <Head title="My Programs" />

   
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">My Programs</h1>
        <p class="mt-1 text-sm text-gray-500">
            You are enrolled in
            <span class="font-medium text-gray-700">{{ count }}</span>
            {{ label }}.
        </p>
    </div>

   
    <div v-if="programs.length" class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div
            v-for="program in programs"
            :key="program.id"
            class="rounded-xl border border-gray-100 bg-white p-5 transition-colors hover:border-gray-200"
        >
            <!-- Icon + name -->
            <div class="mb-3 flex items-start gap-3">
                <div
                    class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-violet-50"
                >
                    <!-- Briefcase icon (inline SVG — no package needed) -->
                    <svg
                        class="h-5 w-5 text-violet-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"
                        />
                    </svg>
                </div>
                <h3
                    class="pt-1.5 text-sm leading-snug font-semibold text-gray-900"
                >
                    {{ program.name }}
                </h3>
            </div>

            <!-- Description -->
            <p
                v-if="program.description"
                class="mb-4 text-sm leading-relaxed text-gray-500"
            >
                {{ program.description }}
            </p>
            <p v-else class="mb-4 text-sm text-gray-400 italic">
                No description provided.
            </p>

            <!-- Divider -->
            <hr class="mb-4 border-gray-100" />

            <!-- Footer: badge + optional member count -->
            <div class="flex items-center justify-between">
                <!-- Enrolled since badge -->
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-800"
                >
                    <svg
                        class="h-3 w-3"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 9v7.5"
                        />
                    </svg>
                    Enrolled In {{ formatDate(program.created_at) }}
                </span>

                <!-- Member count (only shown if controller passes it) -->
                <span
                    v-if="program.members_count !== undefined"
                    class="flex items-center gap-1 text-xs text-gray-400"
                >
                    <svg
                        class="h-3.5 w-3.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                        />
                    </svg>
                    {{ program.members_count }} members
                </span>
            </div>
        </div>
    </div>

    <!-- ── Empty state ───────────────────────────────────────────────────── -->
    <div
        v-else
        class="flex flex-col items-center justify-center py-20 text-center"
    >
        <div
            class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100"
        >
            <svg
                class="h-7 w-7 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"
                />
            </svg>
        </div>
        <p class="text-sm font-medium text-gray-900">No programs yet</p>
        <p class="mt-1.5 text-sm leading-relaxed text-gray-400">
            You haven't been assigned to any programs.<br />
            Contact the admin if you think this is a mistake.
        </p>
    </div>
</template>
