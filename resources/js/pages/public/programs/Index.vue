<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";

import SectionHeading from "@/components/public/SectionHeading.vue";
import Breadcrumbs from "@/components/public/Breadcrumbs.vue";
import CTASection from "@/components/public/CTASection.vue";
import ProgramCard from "@/components/public/ProgramCard.vue";
import { demoPrograms } from "@/composables/useDemoData";
import type { Program } from "@/types/public";

const props = defineProps<{ programs?: Program[] }>();
defineOptions({ layout: null });

const data = computed(() => props.programs ?? demoPrograms);
const activeCategory = ref<string>("All");
const activeStatus = ref<string>("All");

const categories = computed(() => ["All", ...new Set(data.value.map(p => p.category))]);
const statuses = ["All", "upcoming", "active", "completed"];

const filtered = computed(() => data.value.filter(p =>
  (activeCategory.value === "All" || p.category === activeCategory.value) &&
  (activeStatus.value === "All" || p.status === activeStatus.value)
));
const featured = computed(() => data.value.find(p => p.status === "active") ?? data.value[0]);
</script>

<template>
  <Head>
    <title>Programs — UnitySphere</title>
    <meta name="description" content="Browse UnitySphere's portfolio of programs — leadership, health, education, climate, and more." />
  </Head>

 
    <section class="hero-grad border-b border-border pb-12 pt-16">
      <div class="container-page">
        <Breadcrumbs :items="[{ label: 'Programs' }]" />
        <div class="mt-6 max-w-3xl">
          <h1 class="font-display text-4xl text-balance md:text-5xl">Programs</h1>
          <p class="mt-3 text-base text-muted-foreground text-pretty md:text-lg">
            From leadership academies to clean water infrastructure — what we ship, where we ship it, and how it's going.
          </p>
        </div>
      </div>
    </section>

    <section class="section-y">
      <div class="container-page">
        <article class="group grid items-stretch overflow-hidden rounded-3xl border border-border bg-card md:grid-cols-2">
          <div class="relative aspect-[16/10] md:aspect-auto bg-[var(--gradient-brand)]">
            <div class="absolute inset-0 opacity-30" style="background:radial-gradient(circle at 30% 30%, rgba(255,255,255,0.4), transparent 60%)" />
            <div class="absolute left-5 top-5 flex gap-2">
              <span class="rounded-full bg-background/90 px-3 py-1 text-xs font-medium text-foreground backdrop-blur">Featured</span>
              <span class="rounded-full bg-background/90 px-3 py-1 text-xs font-medium capitalize text-foreground backdrop-blur">{{ featured.status }}</span>
            </div>
          </div>
          <div class="flex flex-col justify-center gap-4 p-8 md:p-12">
            <span class="text-xs font-semibold uppercase tracking-wider text-brand">{{ featured.category }}</span>
            <h2 class="font-display text-3xl text-balance md:text-4xl">{{ featured.title }}</h2>
            <p class="text-muted-foreground text-pretty">{{ featured.excerpt }}</p>
            <a :href="`/programs/${featured.slug}`" class="mt-2 inline-flex w-fit items-center gap-2 rounded-md bg-[var(--gradient-brand)] px-5 py-2.5 text-sm font-medium text-brand-foreground shadow-[var(--shadow-glow)] hover:opacity-95">
              View program
            </a>
          </div>
        </article>
      </div>
    </section>

    <section class="border-t border-border">
      <div class="container-page py-8">
        <div class="flex flex-wrap items-center gap-4">
          <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">Category</span>
            <button v-for="c in categories" :key="c" @click="activeCategory = c"
              :class="['rounded-full px-3 py-1.5 text-xs font-medium transition-colors', activeCategory === c ? 'bg-brand text-brand-foreground' : 'bg-secondary text-secondary-foreground hover:bg-accent']">
              {{ c }}
            </button>
          </div>
          <div class="ml-auto flex flex-wrap items-center gap-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">Status</span>
            <button v-for="s in statuses" :key="s" @click="activeStatus = s"
              :class="['rounded-full px-3 py-1.5 text-xs font-medium capitalize transition-colors', activeStatus === s ? 'bg-brand text-brand-foreground' : 'bg-secondary text-secondary-foreground hover:bg-accent']">
              {{ s }}
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="pb-24">
      <div class="container-page">
        <div v-if="filtered.length" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          <ProgramCard v-for="p in filtered" :key="p.id" :program="p" />
        </div>
        <div v-else class="rounded-2xl border border-dashed border-border bg-card p-16 text-center">
          <p class="text-sm text-muted-foreground">No programs match your filters yet.</p>
        </div>
      </div>
    </section>

    <CTASection />
 
</template>
