<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface CommitteeNodeType {
    id: number;
    name: string;
    parent_id?: number | null;
    children?: CommitteeNodeType[];
    children_recursive?: CommitteeNodeType[];
}

const props = defineProps<{
    node: CommitteeNodeType;
    depth: number;
}>();

const isExpanded = ref(true);

const hasChildren = computed(() => {
    const children = props.node.children ?? props.node.children_recursive;

    return (children?.length ?? 0) > 0;
});

const getChildren = computed(() => {
    return props.node.children ?? props.node.children_recursive ?? [];
});

const toggleExpand = () => {
    isExpanded.value = !isExpanded.value;
};

const destroy = (id: number) => {
    if (
        !confirm(
            'Are you sure you want to delete this committee and all its children?',
        )
    ) {
        return;
    }

    router.delete(`admin/committees/${id}`);
};
</script>

<template>
    <li class="committee-node">
        <div
            class="hover:backdrop:*: flex items-center gap-2 rounded border p-3"
            :style="{ marginLeft: `${depth * 24}px` }"
        >
            <button
                v-if="hasChildren"
                @click="toggleExpand"
                class="h-6 w-6 shrink-0 rounded border-red-600 hover:bg-gray-200"
            >
                {{ isExpanded ? '▼' : '▶' }}
            </button>
            <div v-else class="w-6 shrink-0"></div>

            <!-- Committee name -->
            <span class="grow font-medium">{{ node.name }}</span>
            <span class="text-xs text-red-500">
                Children: {{ getChildren.length }}
            </span>

            <!-- Action buttons -->
            <div class="flex gap-2">
                <Link
                    :href="`/admin/committees/${node.id}`"
                    class="rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700"
                >
                    Show
                </Link>

                <Link
                    :href="`/admin/committees/${node.id}/edit`"
                    class="rounded bg-green-600 px-3 py-1 text-sm text-white hover:bg-green-700"
                >
                    Edit
                </Link>

                <button
                    class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700"
                    @click="destroy(node.id)"
                >
                    Delete
                </button>

                <Link
                    :href="`/admin/committees/create?parent_id=${node.id}`"
                    class="rounded bg-amber-500 px-3 py-1 text-sm text-white hover:bg-amber-600"
                >
                    Add Child
                </Link>
            </div>
        </div>

        <!-- Recursive children -->
        <div v-if="hasChildren && isExpanded">
            <ul class="mt-2 space-y-2">
                <CommitteeNode
                    v-for="child in getChildren"
                    :key="child.id"
                    :node="child"
                    :depth="depth + 1"
                />
            </ul>
        </div>
    </li>
</template>
