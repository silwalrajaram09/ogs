<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const form = useForm({
    name: '',
    parent_id: null as number | null,
});

const submit = () => {
    form.post('/admin/programs');
};
</script>

<template>
    <div class="space-y-6 max-w-xl">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">
                Create Program
            </h1>

            <Link
                href="/admin/programs"
                class="text-sm text-muted-foreground hover:text-foreground"
            >
                ← Back
            </Link>
        </div>

        <!-- Form Card -->
        <div class="rounded-lg border bg-background p-6">
            <form @submit.prevent="submit" class="space-y-5">

                <!-- Name -->
                <div class="space-y-2">
                    <label class="text-sm font-medium">
                        Program Name
                    </label>

                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Enter program name"
                    />

                    <p v-if="form.errors.name" class="text-sm text-red-500">
                        {{ form.errors.name }}
                    </p>
                </div>

                <!-- Parent ID -->
                <div class="space-y-2">
                    <label class="text-sm font-medium">
                        Parent Program
                    </label>

                    <input
                        v-model="form.parent_id"
                        type="number"
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Optional parent ID"
                    />

                    <p v-if="form.errors.parent_id" class="text-sm text-red-500">
                        {{ form.errors.parent_id }}
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-3">
                    <button
                        type="submit"
                        class="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:opacity-90"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Program' }}
                    </button>

                    <Link
                        href="/admin/programs"
                        class="text-sm text-muted-foreground hover:text-foreground"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>