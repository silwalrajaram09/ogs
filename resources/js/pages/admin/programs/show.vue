<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    program: any;
}>();
</script>

<template>
    <div class="space-y-6 max-w-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">
                Program Details
            </h1>

            <Link
                href="/admin/programs"
                class="text-sm text-muted-foreground hover:text-foreground"
            >
                ← Back
            </Link>
        </div>

        <!-- Card -->
        <div class="rounded-lg border bg-background p-6 space-y-4">

            <!-- ID -->
            <div class="flex items-center justify-between border-b pb-3">
                <span class="text-sm text-muted-foreground">
                    ID
                </span>
                <span class="font-medium">
                    {{ program.id }}
                </span>
            </div>

            <!-- Name -->
            <div class="flex items-center justify-between border-b pb-3">
                <span class="text-sm text-muted-foreground">
                    Name
                </span>
                <span class="font-medium">
                    {{ program.name }}
                </span>
            </div>

            <!-- Parent -->
            <div class="flex items-center justify-between">
                <span class="text-sm text-muted-foreground">
                    Parent Program
                </span>
                <span class="font-medium">
                    {{ program.parent?.name ?? 'None' }}
                </span>
            </div>

        </div>

        <!-- Actions -->
        <div class="flex gap-3">
            <Link
                :href="`/admin/programs/${program.id}/edit`"
                class="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:opacity-90"
            >
                Edit Program
            </Link>

            <Link
                href="/admin/programs"
                class="rounded-md border px-4 py-2 text-sm hover:bg-muted"
            >
                Back to List
            </Link>
        </div>

    </div>
</template>