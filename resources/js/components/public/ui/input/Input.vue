<script setup lang="ts">
import { cn } from "@/lib/utils";
defineProps<{ class?: string; modelValue?: string | number; type?: string }>();
defineEmits<{ (e: "update:modelValue", v: string | number): void }>();
</script>
<template>
  <input
    :type="type ?? 'text'"
    :value="modelValue"
    @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    :class="cn('flex h-11 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 transition-colors', $props.class)"
  />
</template>
