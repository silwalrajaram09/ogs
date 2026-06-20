<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import {
    Target,
    Eye,
    Heart,
} from 'lucide-vue-next';

import CTASection from '@/components/public/CTASection.vue';
import SectionHeading from '@/components/public/SectionHeading.vue';
import StatsSection from '@/components/public/StatsSection.vue';

defineProps();

const pillars = [
    {
        icon: Target,
        title: 'Our mission',
        body: 'To equip community-led organizations with the operational, financial, and digital infrastructure to scale without losing their soul.',
    },
    {
        icon: Eye,
        title: 'Our vision',
        body: 'A world where trusted community institutions are the default — not the exception — of civic and social life.',
    },
    {
        icon: Heart,
        title: 'Our values',
        body: 'Transparency. Member-first design. Long-time horizons. The hard work of belonging.',
    },
];

const timeline = [
    {
        year: '2014',
        title: 'UnitySphere founded',
        body: 'Three chapters across two countries. One shared spreadsheet.',
    },
    {
        year: '2017',
        title: 'Programs framework',
        body: 'A common operating model for designing and shipping community programs.',
    },
    {
        year: '2020',
        title: 'Open governance',
        body: 'Committees, minutes, and votes published in the open for every member to read.',
    },
    {
        year: '2023',
        title: 'Platform launch',
        body: 'The UnitySphere platform — the same software we run our own chapters on, now available.',
    },
    {
        year: '2026',
        title: '47 countries',
        body: 'A federation of 142 active committees and 38,000+ members worldwide.',
    },
];

const leaders = [
    {
        name: 'Amara Okafor',
        role: 'Executive Director',
        bio: 'Former civil-society director with 15 years across three continents.',
    },
    {
        name: 'Hiroshi Tanaka',
        role: 'CTO',
        bio: 'Open-source veteran. Believes infrastructure is a form of care.',
    },
    {
        name: 'Priya Raman',
        role: 'Head of Design',
        bio: 'Designs that respect the people on both sides of the screen.',
    },
    {
        name: 'Lena Müller',
        role: 'Director of Programs',
        bio: 'Led field operations from East Africa to Eastern Europe.',
    },
];
</script>

<template>
    <Head>
        <title>
            About UnitySphere — Our mission, vision & values
        </title>

        <meta
            name="description"
            content="UnitySphere is a global federation supporting community-led organizations with operational infrastructure, programs, and an open governance model."
        />
    </Head>

    <section class="hero-grad section-y border-b border-border">
        <div class="container-page">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex items-center rounded-full border border-border bg-background/70 px-3 py-1 text-xs font-medium text-muted-foreground"
                >
                    About us
                </span>

                <h1
                    class="mt-5 font-display text-4xl text-balance md:text-6xl"
                >
                    We build the boring infrastructure of
                    <span class="brand-grad-text">
                        trust
                    </span>.
                </h1>

                <p
                    class="mx-auto mt-5 max-w-2xl text-base text-muted-foreground text-pretty md:text-lg"
                >
                    A federation of 142 committees, 38,000 members, and a single shared belief: communities deserve serious tools.
                </p>
            </div>
        </div>
    </section>

    <section class="section-y">
        <div class="container-page grid gap-6 md:grid-cols-3">
            <div
                v-for="p in pillars"
                :key="p.title"
                class="rounded-2xl border border-border bg-card p-7"
            >
                <span
                    class="grid size-11 place-items-center rounded-xl bg-brand-soft text-brand"
                >
                    <component
                        :is="p.icon"
                        class="size-5"
                    />
                </span>

                <h3 class="mt-5 text-xl font-semibold">
                    {{ p.title }}
                </h3>

                <p
                    class="mt-2 text-sm leading-relaxed text-muted-foreground text-pretty"
                >
                    {{ p.body }}
                </p>
            </div>
        </div>
    </section>

    <StatsSection />

    <section class="section-y">
        <div class="container-page">
            <SectionHeading
                eyebrow="Our story"
                title="A timeline"
                description="The milestones that shaped UnitySphere."
            />

            <ol
                class="relative mt-12 ml-3 border-l-2 border-dashed border-border"
            >
                <li
                    v-for="t in timeline"
                    :key="t.year"
                    class="relative mb-10 pl-8"
                >
                    <span
                        class="absolute -left-[11px] grid size-5 place-items-center rounded-full border-2 border-background bg-brand"
                    />

                    <div
                        class="text-xs font-semibold uppercase tracking-wider text-brand"
                    >
                        {{ t.year }}
                    </div>

                    <h3 class="mt-1 text-lg font-semibold">
                        {{ t.title }}
                    </h3>

                    <p
                        class="mt-1.5 max-w-xl text-sm text-muted-foreground text-pretty"
                    >
                        {{ t.body }}
                    </p>
                </li>
            </ol>
        </div>
    </section>

    <section
        class="section-y border-y border-border bg-card/40"
    >
        <div class="container-page">
            <SectionHeading
                eyebrow="Leadership"
                title="The team behind the platform"
                description="Operators, builders, and field veterans — most of us came from the organizations we now serve."
            />

            <div
                class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4"
            >
                <article
                    v-for="l in leaders"
                    :key="l.name"
                    class="group rounded-2xl border border-border bg-card p-6 transition-all hover:-translate-y-1 hover:shadow-[var(--shadow-elevated)]"
                >
                    <div
                        class="aspect-square w-full rounded-xl bg-[var(--gradient-brand)] opacity-90"
                    />

                    <h3 class="mt-5 text-base font-semibold">
                        {{ l.name }}
                    </h3>

                    <p
                        class="text-xs uppercase tracking-wider text-brand"
                    >
                        {{ l.role }}
                    </p>

                    <p
                        class="mt-3 text-sm text-muted-foreground text-pretty"
                    >
                        {{ l.bio }}
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section
        id="partners"
        class="section-y"
    >
        <div class="container-page">
            <SectionHeading
                align="center"
                eyebrow="Partners"
                title="With the support of"
                description="A few of the organizations who collaborate with us on programs and infrastructure."
            />

            <div
                class="mx-auto mt-10 grid max-w-3xl grid-cols-2 gap-6 sm:grid-cols-4"
            >
                <div
                    v-for="p in [
                        'UNESCO',
                        'Open Society',
                        'Rotary Intl.',
                        'Mozilla',
                        'Ford Foundation',
                        'Hewlett',
                        'Skoll',
                        'Ashoka',
                    ]"
                    :key="p"
                    class="grid h-20 place-items-center rounded-xl border border-border bg-card text-sm font-semibold text-muted-foreground"
                >
                    {{ p }}
                </div>
            </div>
        </div>
    </section>

    <CTASection />
</template>