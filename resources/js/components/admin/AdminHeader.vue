<script setup lang="ts">
import { router } from '@inertiajs/vue3';

const logout = () => {
    router.post('/logout');
};
</script>

<template>
    <header
        class="flex items-center justify-between border-b px-6 py-4"
    >
        <h1 class="text-xl font-semibold">
            Admin Dashboard
        </h1>

        <button
            @click="logout"
            class="rounded-md border px-4 py-2"
        >
            Logout
        </button>
    </header>
</template>