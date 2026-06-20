<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="mb-5 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Committees</h1>

        <Link
            href="admin/committees/create"
            class="rounded bg-amber-500 px-4 py-2 text-white"
        >
            Create
        </Link>
    </div>
</template>
