<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import CTASection from '@/components/public/CTASection.vue';
import FeaturedCommittees from '@/components/public/FeaturedCommittees.vue';
import FeaturedPrograms from '@/components/public/FeaturedPrograms.vue';
import HeroSection from '@/components/public/HeroSection.vue';
import LatestPosts from '@/components/public/LatestPosts.vue';
import NewsletterSection from '@/components/public/NewsletterSection.vue';
import SectionHeading from '@/components/public/SectionHeading.vue';
import StatsSection from '@/components/public/StatsSection.vue';
import TestimonialsSection from '@/components/public/TestimonialsSection.vue';

import type {
    Committee,
    Program,
    Post,
} from '@/types/public';

defineProps<{
    featuredCommittees?: Committee[];
    featuredPrograms?: Program[];
    latestPosts?: Post[];
}>();
</script>

<template>
    <Head>
        <title>
            UnitySphere — The OS for global communities
        </title>

        <meta
            name="description"
            content="UnitySphere helps organizations run committees, programs, and member networks across 47 countries. Built with care, transparency, and a long memory."
        />
    </Head>

    <HeroSection />

    <section class="section-y">
        <div
            class="container-page grid items-center gap-12 lg:grid-cols-2"
        >
            <div>
                <SectionHeading
                    eyebrow="Who we are"
                    title="A network of communities, supported by the right tools."
                    description="UnitySphere is an organization and a platform. We support a global federation of chapters and committees, and we open-source the software they run on. Trust is our infrastructure; software is how we maintain it at scale."
                />
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div
                    v-for="item in [
                        {
                            title: 'Transparent governance',
                            body: 'Every committee, every decision, traceable by every member.',
                        },
                        {
                            title: 'Programs that ship',
                            body: 'A pipeline from idea to launch, with the operational scaffolding.',
                        },
                        {
                            title: 'Member-first design',
                            body: 'Tools that respect how community work actually happens.',
                        },
                        {
                            title: 'Built to last',
                            body: 'Open standards, portable data, no vendor lock-in.',
                        },
                    ]"
                    :key="item.title"
                    class="rounded-xl border border-border bg-card p-5"
                >
                    <h3 class="text-base font-semibold">
                        {{ item.title }}
                    </h3>

                    <p
                        class="mt-1.5 text-sm text-muted-foreground text-pretty"
                    >
                        {{ item.body }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <FeaturedCommittees
        :committees="featuredCommittees"
    />

    <FeaturedPrograms
        :programs="featuredPrograms"
    />

    <StatsSection />

    <LatestPosts
        :posts="latestPosts"
    />

    <TestimonialsSection />

    <CTASection />

    <NewsletterSection />
</template>