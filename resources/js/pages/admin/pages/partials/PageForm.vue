<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { watch, ref } from 'vue';
import {route} from 'ziggy-js';

interface Page {
    id?: number;
    title: string;
    slug: string;
    description: string;
}

const props = defineProps<{ page?: Page }>();

const form = useForm({
    name: props.page?.title ?? '',
    slug:  props.page?.slug  ?? '',
    description :  props.page?.description  ?? '',
});

const slugManuallyEdited = ref(!!props.page?.id);

function slugify(str: string): string {
    return str
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-+|-+$/g, '');
}

watch(() => form.name, (val) => {
    if (!slugManuallyEdited.value){
        form.slug = slugify(val);
    } 
});

function submit() {
    if (props.page?.id) {
        form.put(route('pages.update', props.page.id));
    } else {
        form.post(route('pages.store'));
    }
}
</script>

<template>
    <div class="max-w-3xl">
        <!-- Title -->
        <div class="mb-5">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5" for="pg-title">Title</label>
            <input
                id="pg-title"
                v-model="form.name"
                type="text"
                placeholder="Page title..."
                class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500"
                :class="{ 'border-red-300': form.errors.name }"
            />
            <p v-if="form.errors.name" class="mt-1 text-xs text-red-600">{{ form.errors.name }}</p>
        </div>

        <!-- Slug -->
        <div class="mb-5">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5" for="pg-slug">Slug</label>
            <input
                id="pg-slug"
                v-model="form.slug"
                type="text"
                placeholder="page-slug"
                class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-violet-500"
                :class="{ 'border-red-300': form.errors.slug }"
                @input="slugManuallyEdited = true"
            />
            <p v-if="form.errors.slug" class="mt-1 text-xs text-red-600">{{ form.errors.slug }}</p>
            <p class="mt-1 text-xs text-gray-400">
                yourdomain.com/<span class="text-gray-600">{{ form.slug || '…' }}</span>
            </p>
        </div>

        <!-- Body -->
        <div class="mb-6">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5" for="pg-body">Body</label>
            <textarea
                id="pg-body"
                v-model="form.description"
                rows="12"
                placeholder="Page content..."
                class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm resize-y focus:outline-none focus:ring-2 focus:ring-violet-500"
                :class="{ 'border-red-300': form.errors.description }"
            />
            <p v-if="form.errors.description" class="mt-1 text-xs text-red-600">{{ form.errors.description }}</p>
        </div>

        <!-- Footer -->
        <div class="flex items-center gap-3">
            <button
                @click="submit"
                :disabled="form.processing"
                class="px-5 py-2 bg-violet-600 text-white text-sm rounded-lg hover:bg-violet-700 disabled:opacity-50 transition-colors"
            >
                {{ form.processing ? 'Saving…' : (page?.id ? 'Update page' : 'Create page') }}
            </button>
            <a
                :href="route('pages.index')"
                class="px-4 py-2 text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
            >
                Cancel
            </a>
            <span v-if="form.recentlySuccessful" class="text-sm text-emerald-600">Saved!</span>
        </div>
    </div>
</template>