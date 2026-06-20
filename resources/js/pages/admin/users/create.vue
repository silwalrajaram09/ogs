<script setup lang="ts">
import { Head, useForm, Link } from '@inertiajs/vue3'
import {route} from 'ziggy-js';
import AdminLayout from '@/layouts/AdminLayout.vue'

defineOptions({ layout: AdminLayout })

const form = useForm({
    full_name:           '',
    email:               '',
    password:            '',
    password_confirmation: '',
    designation:         '',
    type:                'user',
    member_type:         '',
    address:             '',
    profile_description: '',
    fb_link:             '',
    youtube_link:        '',
    tiktok_link:         '',
    start_date:          '',
    end_date:            '',
    is_active:           true,
})

function submit() {
    form.post(route('admin.users.store'))
}
</script>

<template>
    <Head title="Create User" />

    <div class="flex flex-col gap-6 p-6 max-w-2xl">

        <!-- Header -->
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">
                <Link :href="route('users.index')" class="hover:text-gray-600">Users</Link>
                <span class="mx-1">/</span> New
            </p>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Create User</h1>
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-5">

            <!-- Basic info -->
            <section class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-xl p-5 flex flex-col gap-4">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Basic Info</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Full Name *</label>
                        <input v-model="form.full_name" type="text" class="field" />
                        <p v-if="form.errors.full_name" class="text-xs text-red-500">{{ form.errors.full_name }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Email *</label>
                        <input v-model="form.email" type="email" class="field" />
                        <p v-if="form.errors.email" class="text-xs text-red-500">{{ form.errors.email }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Password *</label>
                        <input v-model="form.password" type="password" class="field" />
                        <p v-if="form.errors.password" class="text-xs text-red-500">{{ form.errors.password }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Confirm Password *</label>
                        <input v-model="form.password_confirmation" type="password" class="field" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Designation</label>
                        <input v-model="form.designation" type="text" class="field" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Address</label>
                        <input v-model="form.address" type="text" class="field" />
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Profile Description</label>
                    <textarea v-model="form.profile_description" rows="3" class="field resize-none" />
                </div>
            </section>

            <!-- Role & status -->
            <section class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-xl p-5 flex flex-col gap-4">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Role & Status</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">User Type</label>
                        <select v-model="form.type" class="field">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Member Type</label>
                        <input v-model="form.member_type" type="text" class="field" placeholder="e.g. executive, general" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Start Date</label>
                        <input v-model="form.start_date" type="date" class="field" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">End Date</label>
                        <input v-model="form.end_date" type="date" class="field" />
                    </div>
                </div>

                <label class="flex items-center gap-2 cursor-pointer w-fit">
                    <input v-model="form.is_active" type="checkbox" class="w-4 h-4 rounded accent-gray-900" />
                    <span class="text-sm text-gray-700 dark:text-gray-300">Active</span>
                </label>
            </section>

            <!-- Social links -->
            <section class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-xl p-5 flex flex-col gap-4">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Social Links</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Facebook</label>
                        <input v-model="form.fb_link" type="url" class="field" placeholder="https://…" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">YouTube</label>
                        <input v-model="form.youtube_link" type="url" class="field" placeholder="https://…" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">TikTok</label>
                        <input v-model="form.tiktok_link" type="url" class="field" placeholder="https://…" />
                    </div>
                </div>
            </section>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="text-sm font-medium bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-5 py-2 rounded-lg hover:opacity-80 transition-opacity disabled:opacity-50"
                >
                    {{ form.processing ? 'Creating…' : 'Create User' }}
                </button>
                <Link :href="route('users.index')" class="text-sm text-gray-400 hover:text-gray-600">
                    Cancel
                </Link>
            </div>

        </form>
    </div>
</template>

<style scoped>

</style>