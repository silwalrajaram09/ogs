<script setup lang="ts">
import { ref, provide } from "vue";
const open = ref<string | null>(null);
provide("accordion", { open, set: (id: string) => (open.value = open.value === id ? null : id) });
</script>
<template><div class="divide-y divide-border rounded-xl border bg-card"><slot /></div></template>
