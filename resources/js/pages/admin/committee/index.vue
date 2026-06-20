<!-- <script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import CommitteeHeader from './components/CommitteeHeader.vue';
import CommitteeTable from './components/CommitteeTable.vue';

import type { Committee } from './types.js';

defineProps<{
    committees: Committee[];
}>();
</script>

<template>
    <Head title="Committee" />

    <div class="p-5">
        <CommitteeHeader />

        <CommitteeTable :committees="committees" />
    </div>
</template> -->
<!-- <script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import CommitteeTree from './components/CommitteeTree.vue';

interface CommitteeNode {
    id: number;
    name: string;
    parent_id?: number | null;
    children?: CommitteeNode[];
    childrenRecursive?: CommitteeNode[];
}

defineProps<{
    committees: CommitteeNode[];
}>();
</script>

<template>
    <Head title="Committees" />

    <div class="min-h-screen  p-5">
        <CommitteeTree :committees="committees" />
    </div>
</template> -->

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import CommitteeTree from './components/CommitteeTree.vue';

defineOptions({
    layout:AdminLayout,
})

defineProps<{
    committees: any[];
}>();
</script>

<template>
    <Head title="Committees" />

    <div class="p-5">
        <CommitteeTree :committees="committees" />
    </div>
</template>

