<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

interface Post {
    id: number;
    title: string;
    slug: string;
    type: 'announcement' | 'news' | 'blog';
    author: string;
    is_published: boolean;
    published_at: string | null;
    default_photo?: string | null; // 👈 ADD PHOTO PROPERTY
}

defineProps<{ posts: { data: Post[]; links: any[] } }>();

function destroy(post: Post) {
    if (!confirm(`Delete "${post.title}"? This cannot be undone.`)) {
        return;
    }

    router.delete(route('posts.destroy', post.id));
}

const typeBadge: Record<string, string> = {
    announcement: 'bg-violet-50 text-violet-800',
    news: 'bg-emerald-50 text-emerald-800',
    blog: 'bg-amber-50 text-amber-800',
};
</script>

<template>
    <Head title="Posts" />

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Posts</h1>
            <p class="mt-1 text-sm text-gray-500">
                Announcements, news, and blog posts.
            </p>
        </div>
        <Link
            :href="route('posts.create')"
            class="inline-flex items-center gap-2 rounded-lg bg-violet-600 px-4 py-2 text-sm text-white transition-colors hover:bg-violet-700"
        >
            + New post
        </Link>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-100 bg-white">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="w-16 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Image
                    </th> <!-- 👈 ADD IMAGE COLUMN -->
                    <th class="w-24 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Status
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Title
                    </th>
                    <th class="w-28 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Type
                    </th>
                    <th class="w-24 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Author
                    </th>
                    <th class="w-28 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Published
                    </th>
                    <th class="w-24 px-4 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <tr
                    v-for="post in posts.data"
                    :key="post.id"
                    class="transition-colors hover:bg-gray-50"
                >
                    <td class="px-4 py-3">
                        <img 
                            v-if="post.default_photo"
                            :src="post.default_photo" 
                            :alt="post.title"
                            class="h-10 w-10 rounded-lg object-cover border border-gray-200"
                        />
                        <div v-else class="h-10 w-10 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <span
                            v-if="post.is_published"
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-800"
                        >
                            Published
                        </span>
                        <span
                            v-else
                            class="inline-flex items-center gap-1 rounded-full border border-gray-200 bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600"
                        >
                            Draft
                        </span>
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900">
                        {{ post.title }}
                    </td>
                    <td class="px-4 py-3">
                        <span
                            class="rounded-full px-2 py-0.5 text-xs font-medium capitalize"
                            :class="typeBadge[post.type]"
                            >{{ post.type }}</span
                        >
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ post.author }}</td>
                    <td class="px-4 py-3 text-gray-500">
                        {{ post.published_at ?? '—' }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <Link
                                :href="route('posts.edit', post.id)"
                                class="rounded-md border border-gray-200 px-2 py-1 text-xs text-gray-500 transition-colors hover:bg-gray-50 hover:text-gray-900"
                            >
                                Edit
                            </Link>
                            <button
                                @click="destroy(post)"
                                class="rounded-md border border-gray-200 px-2 py-1 text-xs text-gray-400 transition-colors hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                <tr v-if="!posts.data.length">
                    <td colspan="7" class="px-4 py-12 text-center text-sm text-gray-400">
                        No posts yet. Create your first one.
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div
            v-if="posts.links.length > 3"
            class="flex gap-1 border-t border-gray-100 px-4 py-3"
        >
            <Link
                v-for="link in posts.links"
                :key="link.label"
                :href="link.url ?? '#'"
                v-html="link.label"
                :class="[
                    'rounded border px-3 py-1.5 text-xs transition-colors',
                    link.active
                        ? 'border-violet-600 bg-violet-600 text-white'
                        : 'border-gray-200 text-gray-500 hover:bg-gray-50',
                    !link.url ? 'pointer-events-none opacity-40' : '',
                ]"
            />
        </div>
    </div>
</template>