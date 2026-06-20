<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { X, Globe2 } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
import type { NavLink } from "@/types/public";

defineProps<{ open: boolean; links: NavLink[] }>();
const emit = defineEmits<{ (e: "update:open", v: boolean): void }>();
const close = () => emit("update:open", false);
</script>

<template>
  <Transition
    enter-active-class="transition duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100"
    leave-active-class="transition duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0"
  >
    <div v-if="open" class="fixed inset-0 z-[60] bg-background/80 backdrop-blur md:hidden" @click="close" />
  </Transition>
  <Transition
    enter-active-class="transition duration-300" enter-from-class="translate-x-full" enter-to-class="translate-x-0"
    leave-active-class="transition duration-200" leave-from-class="translate-x-0" leave-to-class="translate-x-full"
  >
    <aside
      v-if="open"
      class="fixed inset-y-0 right-0 z-[70] flex w-[85%] max-w-sm flex-col border-l border-border bg-background shadow-2xl md:hidden"
    >
      <div class="flex items-center justify-between border-b border-border px-5 py-4">
        <div class="flex items-center gap-2">
          <span class="grid size-8 place-items-center rounded-lg bg-[var(--gradient-brand)] text-brand-foreground"><Globe2 class="size-4" /></span>
          <span class="font-display text-lg">UnitySphere</span>
        </div>
        <button @click="close" aria-label="Close menu" class="grid size-9 place-items-center rounded-md hover:bg-accent">
          <X class="size-5" />
        </button>
      </div>
      <nav class="flex flex-1 flex-col gap-1 p-4">
        <Link
          v-for="link in links" :key="link.href" :href="link.href" @click="close"
          class="rounded-lg px-4 py-3 text-base font-medium text-foreground hover:bg-accent"
        >{{ link.label }}</Link>
      </nav>
      <div class="grid grid-cols-2 gap-2 border-t border-border p-4">
        <Button as="a" href="/login" variant="outline" @click="close">Sign in</Button>
        <Button as="a" href="/register" variant="brand" @click="close">Join us</Button>
      </div>
    </aside>
  </Transition>
</template>
