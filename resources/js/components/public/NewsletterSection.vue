<script setup lang="ts">
import { ref } from "vue";
import { Mail, Check } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
import { Input } from "@/components/public/ui/input";

const email = ref("");
const submitted = ref(false);
const submit = () => {
  if (!email.value.includes("@")) return;
  submitted.value = true;
};
</script>

<template>
  <section class="section-y">
    <div class="container-page">
      <div class="mx-auto grid max-w-4xl items-center gap-10 rounded-3xl border border-border bg-card p-8 md:grid-cols-[1fr_1.2fr] md:p-12">
        <div>
          <span class="grid size-11 place-items-center rounded-xl bg-brand-soft text-brand"><Mail class="size-5" /></span>
          <h3 class="mt-4 font-display text-2xl text-balance md:text-3xl">Field notes, monthly</h3>
          <p class="mt-2 text-sm text-muted-foreground text-pretty">
            One thoughtful email a month with stories, research, and tools from the UnitySphere network. No noise.
          </p>
        </div>
        <form v-if="!submitted" @submit.prevent="submit" class="flex flex-col gap-3 sm:flex-row">
          <Input v-model="email" type="email" placeholder="you@organization.org" required class="flex-1" />
          <Button variant="brand" type="submit" size="lg">Subscribe</Button>
        </form>
        <div v-else class="flex items-center gap-3 rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-700 dark:text-emerald-300">
          <span class="grid size-7 place-items-center rounded-full bg-emerald-500 text-white"><Check class="size-4" /></span>
          You're in. Watch your inbox for the next issue.
        </div>
      </div>
    </div>
  </section>
</template>
