<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import type { Committee } from '../types';

defineProps<{
    committees: Committee[];
}>();

const destroy = (id: number) => {
    if (confirm('Are you sure?')) {
        router.delete(`committee/${id}`);
    }
};
</script>

<template>
    <table class="w-full border">
        <thead class="bg-green-600">
            <tr>
                <th class="border p-3 text-left">ID</th>
                <th class="border p-3 text-left">Name</th>
                <th class="border p-3 text-left">Parent Committee</th>
                <th class="border p-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="committee in committees" :key="committee.id">
                <td class="border p-3">
                    {{ committee.id }}
                </td>
                <td class="border p-3">
                    {{ committee.name }}
                </td>

                <td class="border p-2">
                    {{ committee.parent?.name ?? 'No Parent' }}
                </td>

                <td class="border p-3">
                    <div class="flex gap-2">
                        <Link
                            :href="`admin/ommittee/${committee.id}`"
                            class="text-blue-500"
                        >
                            Show
                        </Link>

                        <Link
                            :href="`admin/committee/${committee.id}/edit`"
                            class="text-green-500"
                        >
                            Edit
                        </Link>

                        <button
                            class="text-red-500"
                            @click="destroy(committee.id)"
                        >
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
