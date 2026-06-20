<script setup lang="ts">
import { inject, computed } from "vue";
import { ChevronDown } from "lucide-vue-next";
const props = defineProps<{ id: string; question: string }>();
const ctx = inject("accordion") as { open: { value: string | null }; set: (id: string) => void };
const isOpen = computed(() => ctx.open.value === props.id);
</script>
<template>
  <div>
    <button
      type="button"
      class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left font-medium hover:bg-accent/40 transition-colors"
      @click="ctx.set(id)"
      :aria-expanded="isOpen"
    >
      <span class="text-pretty">{{ question }}</span>
      <ChevronDown :class="['size-4 shrink-0 transition-transform duration-200', isOpen && 'rotate-180']" />
    </button>
    <div v-if="isOpen" class="px-5 pb-5 text-sm text-muted-foreground animate-fade-up"><slot /></div>
  </div>
</template>
