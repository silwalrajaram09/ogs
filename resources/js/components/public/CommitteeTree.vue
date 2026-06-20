<script setup lang="ts">
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { ChevronRight, Users, Folder, FolderOpen } from "lucide-vue-next";
import { Badge } from "@/components/public/ui/badge";
import type { Committee } from "@/types/public";

const props = withDefaults(defineProps<{ committees: Committee[]; depth?: number }>(), { depth: 0 });

const expanded = ref<Record<number, boolean>>(
  Object.fromEntries(props.committees.filter(c => c.children?.length).map(c => [c.id, props.depth === 0]))
);
const toggle = (id: number) => (expanded.value[id] = !expanded.value[id]);
</script>

<template>
  <ul :class="['space-y-1.5', depth > 0 && 'ml-5 border-l border-dashed border-border pl-5 mt-1.5']">
    <li v-for="c in committees" :key="c.id">
      <div class="group flex items-start gap-2 rounded-lg p-2.5 transition-colors hover:bg-accent/60">
        <button
          v-if="c.children?.length"
          type="button" @click="toggle(c.id)"
          :aria-expanded="expanded[c.id]" :aria-label="expanded[c.id] ? 'Collapse' : 'Expand'"
          class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-md border border-border bg-background text-muted-foreground hover:text-brand"
        >
          <ChevronRight :class="['size-3.5 transition-transform', expanded[c.id] && 'rotate-90']" />
        </button>
        <span v-else class="mt-0.5 grid size-6 shrink-0 place-items-center text-muted-foreground/60">·</span>

        <span class="mt-0.5 grid size-6 shrink-0 place-items-center text-brand">
          <FolderOpen v-if="expanded[c.id]" class="size-4" />
          <Folder v-else class="size-4" />
        </span>

        <div class="min-w-0 flex-1">
          <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
            <Link :href="`/committees/${c.slug}`" class="font-medium text-foreground hover:text-brand">{{ c.name }}</Link>
            <Badge v-if="c.category" variant="muted" class="text-[10px]">{{ c.category }}</Badge>
            <span class="inline-flex items-center gap-1 text-xs text-muted-foreground"><Users class="size-3" />{{ c.memberCount }}</span>
          </div>
          <p class="mt-0.5 line-clamp-1 text-sm text-muted-foreground">{{ c.description }}</p>
        </div>
      </div>
      <CommitteeTree v-if="c.children?.length && expanded[c.id]" :committees="c.children" :depth="depth + 1" />
    </li>
  </ul>
</template>
