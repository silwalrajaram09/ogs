<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ChevronRight, Home } from "lucide-vue-next";

defineProps<{ items: { label: string; href?: string }[] }>();
</script>

<template>
  <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-sm text-muted-foreground">
    <Link href="/" class="inline-flex items-center gap-1 hover:text-foreground"><Home class="size-3.5" /> Home</Link>
    <template v-for="(item, i) in items" :key="i">
      <ChevronRight class="size-3.5 text-border" />
      <Link v-if="item.href" :href="item.href" class="hover:text-foreground">{{ item.label }}</Link>
      <span v-else class="font-medium text-foreground">{{ item.label }}</span>
    </template>
  </nav>
</template>
