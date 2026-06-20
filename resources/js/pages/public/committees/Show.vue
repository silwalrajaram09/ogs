<script setup lang="ts">
import { computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import { Users, Calendar, ArrowRight, GitBranch } from "lucide-vue-next";
import Breadcrumbs from "@/components/public/Breadcrumbs.vue";
import CommitteeCard from "@/components/public/CommitteeCard.vue";
import CommitteeTree from "@/components/public/CommitteeTree.vue";
import CTASection from "@/components/public/CTASection.vue";
import SectionHeading from "@/components/public/SectionHeading.vue";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { demoCommittees, flattenCommittees } from "@/composables/useDemoData";
import type { Committee } from "@/types/public";

const props = defineProps<{ slug: string; committee?: Committee }>();
defineOptions({ layout: null });

const all = flattenCommittees(demoCommittees);
const committee = computed<Committee>(() => props.committee ?? all.find(c => c.slug === props.slug) ?? demoCommittees[0]);
const related = computed(() => all.filter(c => c.slug !== committee.value.slug && c.category === committee.value.category).slice(0, 3));
</script>

<template>
  <Head>
    <title>{{ committee.name }} — Committee — UnitySphere</title>
    <meta name="description" :content="committee.description" />
  </Head>


    <section class="hero-grad border-b border-border pb-12 pt-16">
      <div class="container-page">
        <Breadcrumbs :items="[{ label: 'Committees', href: '/committees' }, { label: committee.name }]" />
        <div class="mt-6 grid items-center gap-6 lg:grid-cols-[1.4fr_1fr]">
          <div>
            <Badge v-if="committee.category" variant="brand">{{ committee.category }}</Badge>
            <h1 class="mt-4 font-display text-4xl text-balance md:text-5xl">{{ committee.name }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted-foreground text-pretty md:text-lg">{{ committee.description }}</p>
            <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-muted-foreground">
              <span class="inline-flex items-center gap-2"><Users class="size-4 text-brand" /> {{ committee.memberCount }} members</span>
              <span class="inline-flex items-center gap-2"><Calendar class="size-4 text-brand" /> Meets monthly</span>
              <span class="inline-flex items-center gap-2"><GitBranch class="size-4 text-brand" /> {{ committee.children?.length ?? 0 }} subgroups</span>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
              <Button as="a" href="/register" variant="brand">Join this committee <ArrowRight class="size-4" /></Button>
              <Button as="a" href="/contact" variant="outline">Ask a question</Button>
            </div>
          </div>
          <div class="rounded-3xl border border-border bg-card p-6">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-muted-foreground">At a glance</h3>
            <dl class="mt-4 grid grid-cols-2 gap-4 text-sm">
              <div><dt class="text-muted-foreground">Cadence</dt><dd class="mt-1 font-medium">Monthly</dd></div>
              <div><dt class="text-muted-foreground">Status</dt><dd class="mt-1 font-medium text-emerald-600">Active</dd></div>
              <div><dt class="text-muted-foreground">Founded</dt><dd class="mt-1 font-medium">2017</dd></div>
              <div><dt class="text-muted-foreground">Chair</dt><dd class="mt-1 font-medium">Amara Okafor</dd></div>
            </dl>
          </div>
        </div>
      </div>
    </section>

    <section class="section-y">
      <div class="container-page grid gap-12 lg:grid-cols-[1.6fr_1fr]">
        <article class="prose-pretty space-y-5 text-base leading-relaxed text-foreground/90">
          <h2 class="font-display text-2xl md:text-3xl">Mandate</h2>
          <p class="text-muted-foreground text-pretty">
            The {{ committee.name }} is responsible for {{ committee.description.toLowerCase() }} It operates with a published charter, transparent minutes, and a quarterly report to the wider membership.
          </p>
          <h2 class="font-display text-2xl md:text-3xl">Current focus</h2>
          <ul class="space-y-2 text-muted-foreground">
            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-brand" /> Establishing a recurring review cycle with member chapters.</li>
            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-brand" /> Publishing the 2026 working agenda and inviting public comment.</li>
            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-brand" /> Onboarding three new working groups this quarter.</li>
          </ul>
        </article>

        <aside v-if="committee.children?.length" class="rounded-3xl border border-border bg-card p-6 lg:sticky lg:top-24 lg:self-start">
          <h3 class="font-display text-xl">Subgroups</h3>
          <p class="mt-1 text-sm text-muted-foreground">{{ committee.children.length }} working groups under {{ committee.name }}.</p>
          <div class="mt-5"><CommitteeTree :committees="committee.children" /></div>
        </aside>
      </div>
    </section>

    <section v-if="related.length" class="section-y border-t border-border bg-card/40">
      <div class="container-page">
        <SectionHeading title="Related committees" description="Other groups working in the same area." />
        <div class="mt-10 grid gap-6 md:grid-cols-3">
          <CommitteeCard v-for="c in related" :key="c.id" :committee="c" />
        </div>
      </div>
    </section>

    <CTASection />
  
</template>
