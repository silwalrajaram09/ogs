<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    programs: any[];
}>();

const destroy = (id: number) => {
    if (
        !confirm(
            'Are you sure you want to delete this committee and all its children?',
        )
    ) {
        return;
    }

    router.delete(`/admin/programs/${id}`);
};
</script>

<template>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Programs</h1>

            <Link
                href="/admin/programs/create"
                class="rounded-md bg-primary px-4 py-2 text-primary-foreground"
            >
                + Add Program
            </Link>
        </div>

        <!-- Table Card -->
        <div class="overflow-x-auto rounded-lg border bg-background">
            <table class="w-full text-sm">
                <thead class="border-b bg-muted/40">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Parent</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="program in programs"
                        :key="program.id"
                        class="border-b hover:bg-muted/20"
                    >
                        <td class="p-3">
                            {{ program.id }}
                        </td>

                        <td class="p-3 font-medium">
                            {{ program.name }}
                        </td>

                        <td class="p-3">
                            {{ program.parent?.name ?? '-' }}
                        </td>

                        <td class="p-3">
                            <div class="flex items-center gap-4">
                                <Link
                                    :href="`/admin/programs/${program.id}`"
                                    class="text-blue-600 hover:underline"
                                >
                                    View
                                </Link>

                                <Link
                                    :href="`/admin/programs/${program.id}/edit`"
                                    class="text-green-600 hover:underline"
                                >
                                    Edit
                                </Link>

                                <button
                                    @click="destroy(program.id)"
                                    class="text-red-600 hover:underline"
                                >
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr v-if="programs.length === 0">
                        <td
                            colspan="4"
                            class="p-6 text-center text-muted-foreground"
                        >
                            No programs found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
