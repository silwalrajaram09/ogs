<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import CommitteeNode from './CommitteeNode.vue';

interface CommitteeNodeType {
    id: number;
    name: string;
    parent_id?: number | null;
    children?: CommitteeNodeType[];
    children_recursive?: CommitteeNodeType[];
}

const props = defineProps<{
    committees: CommitteeNodeType[];
}>();

// Normalize the data to ensure we always have a 'children' array
const normalizedCommittees = computed(() => {
    return props.committees.map((committee) => ({
        ...committee,
        children: committee.children ?? committee.children_recursive ?? [],
    }));
});
</script>

<template>
    <div class="rounded-lg border p-4">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-bold">Committee Hierarchy</h2>
            <Link
                href="/admin/committees/create"
                class="rounded bg-cyan-900 px-4 py-2 text-white "
            >
                + Create Root Committee
            </Link>
        </div>

        <div
            v-if="normalizedCommittees.length === 0"
            class="py-8 text-center text-gray-500"
        >
            No committees found. Click "Create Root Committee" to get started.
        </div>

        <ul v-else class="space-y-3">
            <CommitteeNode
                v-for="committee in normalizedCommittees"
                :key="committee.id"
                :node="committee"
                :depth="0"
            />
        </ul>
    </div>
</template>