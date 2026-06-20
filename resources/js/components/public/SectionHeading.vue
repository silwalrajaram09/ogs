<script setup lang="ts">
withDefaults(defineProps<{ eyebrow?: string; title: string; description?: string; align?: "left" | "center" }>(), { align: "left" });
</script>
<template>
  <div :class="['max-w-2xl', align === 'center' && 'mx-auto text-center']">
    <span v-if="eyebrow" class="inline-flex items-center rounded-full border border-border bg-brand-soft/40 px-3 py-1 text-xs font-medium text-brand">
      {{ eyebrow }}
    </span>
    <h2 class="mt-4 font-display text-3xl text-foreground text-balance md:text-5xl">{{ title }}</h2>
    <p v-if="description" class="mt-4 text-base text-muted-foreground text-pretty md:text-lg">{{ description }}</p>
  </div>
</template>
