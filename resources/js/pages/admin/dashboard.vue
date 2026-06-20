<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { dashboard } from '@/routes';

const page= usePage();
const user= page.props.auth.user;
defineOptions({
    layout: AdminLayout,
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
});

defineProps<{
    auth_user: any;
}>();
</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">

        <!-- Welcome Card -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <div class="relative aspect-video overflow-hidden rounded-xl border p-4">
                <p>
                    Hello my Name is <strong>{{ user.full_name }}</strong><br>
                    Email: <strong>{{user.email }}</strong><br>
                    Role: <strong>{{ user.type }}</strong>
                </p>
            </div>

        </div>

    </div>
</template>