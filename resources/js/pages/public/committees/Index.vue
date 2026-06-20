<script setup lang="ts">
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";
import { LayoutGrid, ListTree, Search } from "lucide-vue-next";
import PublicLayout from "@/layouts/PublicLayout.vue";
import SectionHeading from "@/components/public/SectionHeading.vue";
import CommitteeCard from "@/components/public/CommitteeCard.vue";
import CommitteeTree from "@/components/public/CommitteeTree.vue";
import Breadcrumbs from "@/components/public/Breadcrumbs.vue";
import { Input } from "@/components/ui/input";
import { demoCommittees, flattenCommittees } from "@/composables/useDemoData";
import type { Committee } from "@/types/public";

const props = defineProps<{ committees?: Committee[] }>();
defineOptions({ layout: null });

const view = ref<"grid" | "tree">("grid");
const search = ref("");

const data = computed(() => props.committees ?? demoCommittees);
const flat = computed(() => flattenCommittees(data.value));
const filteredFlat = computed(() => {
  if (!search.value) return flat.value;
  const q = search.value.toLowerCase();
  return flat.value.filter(c => c.name.toLowerCase().includes(q) || c.description.toLowerCase().includes(q));
});
</script>

<template>
  <Head>
    <title>Committees — UnitySphere</title>
    <meta name="description" content="Explore the standing committees, working groups, and chapters of the UnitySphere federation." />
  </Head>

 
    <section class="hero-grad border-b border-border pb-12 pt-16">
      <div class="container-page">
        <Breadcrumbs :items="[{ label: 'Committees' }]" />
        <div class="mt-6 flex flex-wrap items-end justify-between gap-6">
          <div class="max-w-2xl">
            <h1 class="font-display text-4xl text-balance md:text-5xl">Committees</h1>
            <p class="mt-3 text-base text-muted-foreground text-pretty md:text-lg">
              {{ flat.length }} groups across governance, programs, and community engagement — fully nested, fully transparent.
            </p>
          </div>
          <div class="flex w-full max-w-md items-center gap-2 sm:w-auto">
            <div class="relative flex-1">
              <Search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground" />
              <Input v-model="search" placeholder="Search committees..." class="pl-9" />
            </div>
            <div class="inline-flex shrink-0 rounded-md border border-border bg-card p-1">
              <button @click="view = 'grid'" :class="['grid size-9 place-items-center rounded transition-colors', view==='grid' ? 'bg-brand text-brand-foreground' : 'text-muted-foreground hover:text-foreground']" aria-label="Grid view"><LayoutGrid class="size-4" /></button>
              <button @click="view = 'tree'" :class="['grid size-9 place-items-center rounded transition-colors', view==='tree' ? 'bg-brand text-brand-foreground' : 'text-muted-foreground hover:text-foreground']" aria-label="Tree view"><ListTree class="size-4" /></button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-y">
      <div class="container-page">
        <div v-if="view === 'grid'">
          <div v-if="filteredFlat.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <CommitteeCard v-for="c in filteredFlat" :key="c.id" :committee="c" />
          </div>
          <div v-else class="rounded-2xl border border-dashed border-border bg-card p-16 text-center">
            <p class="text-sm text-muted-foreground">No committees match "{{ search }}".</p>
          </div>
        </div>

        <div v-else class="rounded-2xl border border-border bg-card p-6 md:p-8">
          <SectionHeading title="Federation hierarchy" description="Expand any committee to see its working groups and subcommittees." />
          <div class="mt-8"><CommitteeTree :committees="data" /></div>
        </div>
      </div>
    </section>

</template>
