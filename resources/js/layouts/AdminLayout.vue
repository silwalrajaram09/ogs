<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import AdminSidebar from '@/components/admin/AdminSidebar.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';

import {
    SidebarInset,
    SidebarProvider,
} from '@/components/ui/sidebar';

const page = usePage();

const breadcrumbs = page.props.breadcrumbs ?? [];
</script>

<template>
    <SidebarProvider>
        <AdminSidebar />

        <SidebarInset>
            <div class="flex flex-1 flex-col">

                <header class="border-b px-6 py-4">
                    <Breadcrumbs :breadcrumbs="breadcrumbs" />
                </header>

                <main class="flex flex-1 flex-col p-6">
                    <slot />
                </main>

            </div>
        </SidebarInset>
    </SidebarProvider>
</template>