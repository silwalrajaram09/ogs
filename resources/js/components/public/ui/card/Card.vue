<script setup lang="ts">
import { cn } from "@/lib/utils";
defineProps<{ class?: string }>();
</script>
<template>
  <div :class="cn('rounded-xl border bg-card text-card-foreground shadow-[var(--shadow-soft)] transition-all', $props.class)">
    <slot />
  </div>
</template>
