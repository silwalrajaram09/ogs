<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ArrowRight } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
import SectionHeading from "./SectionHeading.vue";
import CommitteeCard from "./CommitteeCard.vue";
import { demoCommittees } from "@/composables/useDemoData";
import type { Committee } from "@/types/public";

defineProps<{ committees?: Committee[] }>();
</script>

<template>
  <section class="section-y">
    <div class="container-page">
      <div class="flex flex-wrap items-end justify-between gap-6">
        <SectionHeading
          eyebrow="Committees" title="Where decisions actually happen"
          description="Standing committees, working groups, and chapters — each with their own remit and rhythm."
        />
        <Button as-child variant="outline">
          <Link href="/committees">Browse all <ArrowRight class="size-4" /></Link>
        </Button>
      </div>
      <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <CommitteeCard v-for="c in (committees ?? demoCommittees).slice(0, 4)" :key="c.id" :committee="c" />
      </div>
    </div>
  </section>
</template>
