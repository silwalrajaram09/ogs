<script setup lang="ts">
defineProps<{
    form: any;
    parents: any[];
    submit: () => void;
}>();
</script>

<template>
    <form class="space-y-4" @submit.prevent="submit">
        <!-- Name -->
        <div>
            <label class="mb-1 block"> Name </label>

            <input
                v-model="form.name"
                type="text"
                class="w-full rounded border p-2"
            />

            <div v-if="form.errors.name" class="mt-1 text-sm text-red-500">
                {{ form.errors.name }}
            </div>
        </div>

        <!-- Parent -->
        <div>
            <label class="mb-1 block"> Parent Committee </label>

            <select
                v-model.number="form.parent_id"
                class="w-full rounded border p-2"
            >
                <option :value="null">None</option>

                <option
                    v-for="parent in parents"
                    :key="parent.id"
                    :value="parent.id"
                >
                    {{ parent.name }}
                </option>
            </select>

            <div v-if="form.errors.parent_id" class="mt-1 text-sm text-red-500">
                {{ form.errors.parent_id }}
            </div>
        </div>

        <!-- Button -->
        <button
            type="submit"
            :disabled="form.processing"
            class="rounded bg-amber-500 px-5 py-2 text-white disabled:opacity-50"
        >
            {{ form.processing ? 'Submitting...' : 'Submit' }}
        </button>
    </form>
</template>
