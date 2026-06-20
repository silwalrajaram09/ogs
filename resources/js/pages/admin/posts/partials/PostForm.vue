<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { watch, ref, computed } from 'vue';
import { route } from 'ziggy-js';

interface Post {
    id?: number;
    title: string;
    slug: string;
    type: 'announcement' | 'news' | 'blog';
    body: string;
    is_published: boolean;
    default_photo?: string | null; // 👈 ADD PHOTO PROPERTY
    default_photo_path?: string | null; // 👈 ADD RAW PATH
}

const props = defineProps<{
    post?: Post;
}>();

const form = useForm({
    title: props.post?.title ?? '',
    slug: props.post?.slug ?? '',
    type: props.post?.type ?? 'announcement',
    body: props.post?.body ?? '',
    is_published: props.post?.is_published ?? false,
    default_photo: null as File | null, // 👈 ADD PHOTO FILE
});

const slugManuallyEdited = ref(!!props.post?.id);
const photoPreview = ref<string | null>(props.post?.default_photo || null);

function slugify(str: string): string {
    return str
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-+|-+$/g, '');
}

watch(
    () => form.title,
    (newTitle) => {
        if (!slugManuallyEdited.value) {
            form.slug = slugify(newTitle);
        }
    },
);

// 👈 HANDLE PHOTO PREVIEW
function handlePhotoChange(event: Event) {
    const input = event.target as HTMLInputElement;

    if (input.files && input.files.length > 0) {
        const file = input.files[0];
        form.default_photo = file;

        // Create preview
        const reader = new FileReader();
        reader.onload = (e) => {
            photoPreview.value = e.target?.result as string;
        };
        reader.readAsDataURL(file);
    }
}

// 👈 REMOVE PHOTO
function removePhoto() {
    form.default_photo = null;
    photoPreview.value = null;
}

// 👈 CHECK IF PHOTO EXISTS
const hasPhoto = computed(() => {
    return photoPreview.value || props.post?.default_photo;
});

function submit() {
    // 👈 USE POST/PUT WITH FILES
    if (props.post?.id) {
        form.post(route('posts.update', props.post.id), {
            forceFormData: true, // Important for file uploads
        });
    } else {
        form.post(route('posts.store'), {
            forceFormData: true, // Important for file uploads
        });
    }
}
</script>

<template>
    <div class="max-w-3xl">
        <!-- Title -->
        <div class="mb-5">
            <label
                class="mb-1.5 block text-xs font-medium tracking-wide text-gray-500 uppercase"
                for="title"
            >
                Title
            </label>
            <input
                id="title"
                v-model="form.title"
                type="text"
                placeholder="Post title..."
                class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none"
                :class="{ 'border-red-300': form.errors.title }"
            />
            <p v-if="form.errors.title" class="mt-1 text-xs text-red-600">
                {{ form.errors.title }}
            </p>
        </div>

        <!-- Slug + Type in two columns -->
        <div class="mb-5 grid grid-cols-2 gap-4">
            <div>
                <label
                    class="mb-1.5 block text-xs font-medium tracking-wide text-gray-500 uppercase"
                    for="slug"
                >
                    Slug
                </label>
                <input
                    id="slug"
                    v-model="form.slug"
                    type="text"
                    placeholder="post-slug"
                    class="w-full rounded-lg border border-gray-200 px-3 py-2 font-mono text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none"
                    :class="{ 'border-red-300': form.errors.slug }"
                    @input="slugManuallyEdited = true"
                />
                <p v-if="form.errors.slug" class="mt-1 text-xs text-red-600">
                    {{ form.errors.slug }}
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    yourdomain.com/posts/<span class="text-gray-600">{{
                        form.slug || '…'
                    }}</span>
                </p>
            </div>
            <div>
                <label
                    class="mb-1.5 block text-xs font-medium tracking-wide text-gray-500 uppercase"
                    for="type"
                >
                    Type
                </label>
                <select
                    id="type"
                    v-model="form.type"
                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none"
                >
                    <option value="announcement">Announcement</option>
                    <option value="news">News</option>
                    <option value="blog">Blog</option>
                </select>
            </div>
        </div>

        <!-- 👈 ADD PHOTO UPLOAD SECTION -->
        <div class="mb-5">
            <label
                class="mb-1.5 block text-xs font-medium tracking-wide text-gray-500 uppercase"
            >
                Featured Image
            </label>

            <!-- Photo Preview -->
            <div v-if="hasPhoto" class="relative mb-3">
                <div class="relative inline-block">
                    <img
                        src="photoPreview || props.post?.default_photo"
                        alt="Post image"
                        class="h-40 w-auto rounded-lg border border-gray-200 object-cover"
                    />
                    <button
                        @click="removePhoto"
                        type="button"
                        class="absolute -top-2 -right-2 rounded-full bg-red-500 p-1 text-white transition-colors hover:bg-red-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Upload Button -->
            <div class="flex items-center gap-3">
                <label class="cursor-pointer">
                    <span
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-600 transition-colors hover:bg-gray-50"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 3a1 1 0 011 1v.586l.293-.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414l.293.293V9a1 1 0 011-1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        {{ hasPhoto ? 'Change photo' : 'Upload photo' }}
                    </span>
                    <input
                        type="file"
                        accept="image/*"
                        class="hidden"
                        @change="handlePhotoChange"
                    />
                </label>
                <p class="text-xs text-gray-400">JPG, PNG, WEBP up to 2MB</p>
            </div>
            <p
                v-if="form.errors.default_photo"
                class="mt-1 text-xs text-red-600"
            >
                {{ form.errors.default_photo }}
            </p>
        </div>

        <!-- Body -->
        <div class="mb-5">
            <label
                class="mb-1.5 block text-xs font-medium tracking-wide text-gray-500 uppercase"
                for="body"
            >
                Body
            </label>
            <textarea
                id="body"
                v-model="form.body"
                rows="10"
                placeholder="Write the post content here..."
                class="w-full resize-y rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none"
                :class="{ 'border-red-300': form.errors.body }"
            />
            <p v-if="form.errors.body" class="mt-1 text-xs text-red-600">
                {{ form.errors.body }}
            </p>
        </div>

        <!-- Publish toggle -->
        <div
            class="mb-6 flex items-start gap-3 rounded-lg border border-gray-200 p-4"
        >
            <input
                id="is_published"
                v-model="form.is_published"
                type="checkbox"
                class="mt-0.5 h-4 w-4 cursor-pointer rounded"
            />
            <label for="is_published" class="cursor-pointer">
                <p class="text-sm font-medium text-gray-900">
                    Publish immediately
                </p>
                <p class="mt-0.5 text-xs text-gray-500">
                    Members can see published posts. Uncheck to save as draft.
                </p>
            </label>
        </div>

        <!-- Footer -->
        <div class="flex items-center gap-3">
            <button
                @click="submit"
                :disabled="form.processing"
                class="rounded-lg bg-violet-600 px-5 py-2 text-sm text-white transition-colors hover:bg-violet-700 disabled:opacity-50"
            >
                {{
                    form.processing
                        ? 'Saving…'
                        : post?.id
                          ? 'Update post'
                          : 'Create post'
                }}
            </button>
            <a
                :href="route('posts.index')"
                class="rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-500 transition-colors hover:bg-gray-50"
            >
                Cancel
            </a>
            <span
                v-if="form.recentlySuccessful"
                class="text-sm text-emerald-600"
                >Saved!</span
            >
        </div>
    </div>
</template>
