<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { Calendar, MapPin, Users, CheckCircle2, ArrowRight } from "lucide-vue-next";
import { computed } from "vue";
import Breadcrumbs from "@/components/public/Breadcrumbs.vue";
import CTASection from "@/components/public/CTASection.vue";
import ProgramCard from "@/components/public/ProgramCard.vue";
import SectionHeading from "@/components/public/SectionHeading.vue";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { demoPrograms } from "@/composables/useDemoData";
import PublicLayout from "@/layouts/PublicLayout.vue";
import { formatDate } from "@/lib/utils";
import type { Program } from "@/types/public";

const props = defineProps<{ slug: string; program?: Program }>();
defineOptions({layout:null});

const program = computed(() => props.program ?? demoPrograms.find(p => p.slug === props.slug) ?? demoPrograms[0]);
const related = computed(() => demoPrograms.filter(p => p.slug !== program.value.slug).slice(0, 3));

const milestones = [
  { date: "Phase 1", title: "Discovery & partner onboarding", body: "Map needs, sign MoUs with implementation partners.", done: true },
  { date: "Phase 2", title: "Pilot in three chapters", body: "Test the design with real members, iterate weekly.", done: true },
  { date: "Phase 3", title: "Regional rollout", body: "Scale to all chapters within the region, with full operational support.", done: false },
  { date: "Phase 4", title: "Open-source the playbook", body: "Publish materials so other organizations can replicate.", done: false },
];
</script>

<template>
  <Head>
    <title>{{ program.title }} — Programs — UnitySphere</title>
    <meta name="description" :content="program.excerpt" />
  </Head>

 
    <section class="hero-grad border-b border-border pb-12 pt-16">
      <div class="container-page">
        <Breadcrumbs :items="[{ label: 'Programs', href: '/programs' }, { label: program.title }]" />
        <div class="mt-6 grid items-center gap-10 lg:grid-cols-[1.3fr_1fr]">
          <div>
            <div class="flex flex-wrap gap-2">
              <Badge variant="brand">{{ program.category }}</Badge>
              <Badge :variant="program.status === 'active' ? 'success' : program.status === 'upcoming' ? 'warning' : 'muted'" class="capitalize">{{ program.status }}</Badge>
            </div>
            <h1 class="mt-4 font-display text-4xl text-balance md:text-6xl">{{ program.title }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted-foreground text-pretty md:text-lg">{{ program.excerpt }}</p>
            <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-muted-foreground">
              <span class="inline-flex items-center gap-2"><Calendar class="size-4 text-brand" />Starts {{ formatDate(program.startDate) }}</span>
              <span v-if="program.location" class="inline-flex items-center gap-2"><MapPin class="size-4 text-brand" />{{ program.location }}</span>
              <span class="inline-flex items-center gap-2"><Users class="size-4 text-brand" />200+ participants</span>
            </div>
          </div>
          <div class="rounded-3xl border border-border bg-card p-8 shadow-[var(--shadow-elevated)]">
            <h3 class="font-display text-xl">Register your interest</h3>
            <p class="mt-2 text-sm text-muted-foreground">Applications open until two weeks before the start date.</p>
            <Button as="a" href="/register" variant="brand" size="lg" class="mt-6 w-full justify-center">Apply now <ArrowRight class="size-4" /></Button>
            <Button as="a" href="/contact" variant="outline" size="lg" class="mt-3 w-full justify-center">Ask a question</Button>
          </div>
        </div>
      </div>
    </section>

    <section class="section-y">
      <div class="container-page grid gap-12 lg:grid-cols-[1.6fr_1fr]">
        <article class="space-y-6 text-base leading-relaxed text-foreground/90">
          <h2 class="font-display text-2xl md:text-3xl">About this program</h2>
          <p class="text-muted-foreground text-pretty">
            {{ program.excerpt }} The program is designed and run in partnership with local chapters, with curriculum, mentorship, and measurable outcomes published openly at the end of each cycle.
          </p>
          <h2 class="font-display text-2xl md:text-3xl">What you'll get</h2>
          <ul class="space-y-3 text-muted-foreground">
            <li v-for="b in ['Hands-on coursework with weekly cohort sessions','One-on-one mentorship from senior UnitySphere members','Access to our network of 38,000 members across 47 countries','A capstone project shipped with a real chapter']" :key="b" class="flex items-start gap-3">
              <CheckCircle2 class="mt-0.5 size-5 shrink-0 text-brand" /><span>{{ b }}</span>
            </li>
          </ul>
        </article>

        <aside class="lg:sticky lg:top-24 lg:self-start">
          <div class="rounded-3xl border border-border bg-card p-6">
            <h3 class="font-display text-xl">Timeline</h3>
            <ol class="relative mt-5 border-l-2 border-dashed border-border pl-5">
              <li v-for="(m, i) in milestones" :key="i" class="relative mb-6 last:mb-0">
                <span :class="['absolute -left-[27px] grid size-5 place-items-center rounded-full border-2 border-card', m.done ? 'bg-brand' : 'bg-muted']">
                  <CheckCircle2 v-if="m.done" class="size-3 text-brand-foreground" />
                </span>
                <div class="text-xs font-semibold uppercase tracking-wider text-brand">{{ m.date }}</div>
                <div class="mt-0.5 text-sm font-semibold">{{ m.title }}</div>
                <div class="mt-1 text-xs text-muted-foreground">{{ m.body }}</div>
              </li>
            </ol>
          </div>
        </aside>
      </div>
    </section>

    <section class="section-y border-t border-border bg-card/40">
      <div class="container-page">
        <SectionHeading title="More programs" />
        <div class="mt-10 grid gap-6 md:grid-cols-3">
          <ProgramCard v-for="p in related" :key="p.id" :program="p" />
        </div>
      </div>
    </section>

    <CTASection />
 
</template>
