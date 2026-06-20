<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ArrowRight } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
import SectionHeading from "./SectionHeading.vue";
import ProgramCard from "./ProgramCard.vue";
import { demoPrograms } from "@/composables/useDemoData";
import type { Program } from "@/types/public";

defineProps<{ programs?: Program[] }>();
</script>

<template>
  <section class="section-y bg-card/40 border-y border-border">
    <div class="container-page">
      <div class="flex flex-wrap items-end justify-between gap-6">
        <SectionHeading
          eyebrow="Programs" title="Featured programs"
          description="The current slate of UnitySphere programs — built with chapters, run with care."
        />
        <Button as-child variant="outline">
          <Link href="/programs">All programs <ArrowRight class="size-4" /></Link>
        </Button>
      </div>
      <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <ProgramCard v-for="p in (programs ?? demoPrograms).slice(0, 3)" :key="p.id" :program="p" />
      </div>
    </div>
  </section>
</template>
