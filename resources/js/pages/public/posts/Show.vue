<script setup lang="ts">
import { computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import { Clock,  Link2 } from "lucide-vue-next";
import PublicLayout from "@/layouts/PublicLayout.vue";
import Breadcrumbs from "@/components/public/Breadcrumbs.vue";
import SectionHeading from "@/components/public/SectionHeading.vue";
import PostCard from "@/components/public/PostCard.vue";
import NewsletterSection from "@/components/public/NewsletterSection.vue";
import { Badge } from "@/components/ui/badge";
import { formatDate } from "@/lib/utils";
import { demoPosts } from "@/composables/useDemoData";
import type { Post } from "@/types/public";

const props = defineProps<{ slug: string; post?: Post }>();
defineOptions({ layout: PublicLayout });

const post = computed(() => props.post ?? demoPosts.find(p => p.slug === props.slug) ?? demoPosts[0]);
const related = computed(() => demoPosts.filter(p => p.slug !== post.value.slug).slice(0, 3));
</script>

<template>
  <Head>
    <title>{{ post.title }} — UnitySphere</title>
    <meta name="description" :content="post.excerpt" />
  </Head>

 
    <article>
      <header class="hero-grad border-b border-border pb-14 pt-16">
        <div class="container-page mx-auto max-w-3xl">
          <Breadcrumbs :items="[{ label: 'Blog', href: '/posts' }, { label: post.title }]" />
          <Badge variant="brand" class="mt-6">{{ post.category }}</Badge>
          <h1 class="mt-4 font-display text-4xl text-balance md:text-6xl">{{ post.title }}</h1>
          <p class="mt-5 text-lg text-muted-foreground text-pretty">{{ post.excerpt }}</p>
          <div class="mt-8 flex flex-wrap items-center justify-between gap-4 border-t border-border pt-6">
            <div class="flex items-center gap-3">
              <span class="grid size-11 place-items-center rounded-full bg-[var(--gradient-brand)] text-sm font-semibold text-brand-foreground">
                {{ post.author.name.split(' ').map(p => p[0]).slice(0,2).join('') }}
              </span>
              <div>
                <p class="text-sm font-semibold">{{ post.author.name }}</p>
                <p class="text-xs text-muted-foreground">{{ post.author.role }} · {{ formatDate(post.publishedAt) }} · <span class="inline-flex items-center gap-1"><Clock class="size-3" />{{ post.readMinutes }} min read</span></p>
              </div>
            </div>
            <div class="flex items-center gap-2 text-muted-foreground">
              <a href="#" aria-label="Share on Twitter" class="grid size-9 place-items-center rounded-md border border-border hover:border-brand hover:text-brand"><Twitter class="size-4" /></a>
              <a href="#" aria-label="Share on LinkedIn" class="grid size-9 place-items-center rounded-md border border-border hover:border-brand hover:text-brand"><Linkedin class="size-4" /></a>
              <a href="#" aria-label="Copy link" class="grid size-9 place-items-center rounded-md border border-border hover:border-brand hover:text-brand"><Link2 class="size-4" /></a>
            </div>
          </div>
        </div>
      </header>

      <section class="section-y">
        <div class="container-page grid gap-12 lg:grid-cols-[1fr_3fr_1fr]">
          <aside class="hidden lg:block" />
          <div class="prose-pretty space-y-6 text-lg leading-relaxed text-foreground/90">
            <p class="text-pretty">In community work, the question is never just <em>what should we do</em> — it's <em>how do we keep doing it together, well, for a long time</em>. That second question is the one we built UnitySphere to answer.</p>
            <h2 class="font-display text-2xl text-foreground md:text-3xl">The shape of the problem</h2>
            <p class="text-muted-foreground text-pretty">When chapters scale past their founding team, the implicit agreements that held things together stop scaling with them. New members arrive without the context. Decisions get made and remade because nobody can find the last one. Programs ship, but nobody learns from them, because the lessons live in the heads of the people who left.</p>
            <p class="text-muted-foreground text-pretty">Software can't fix this on its own. But the right tools, used by people who care, can make the difference between an organization that keeps its promises and one that gradually stops being able to.</p>
            <h2 class="font-display text-2xl text-foreground md:text-3xl">What changed for us</h2>
            <p class="text-muted-foreground text-pretty">We started publishing committee minutes in the open. We rebuilt member onboarding around a single, calm experience. We invested in the unglamorous parts of governance — agendas, voting records, follow-through — and we watched membership trust rise alongside membership numbers.</p>
            <blockquote class="border-l-2 border-brand pl-6 italic text-foreground">
              Trust is built one fulfilled commitment at a time. The platform is the place where commitments live.
            </blockquote>
            <h2 class="font-display text-2xl text-foreground md:text-3xl">What's next</h2>
            <p class="text-muted-foreground text-pretty">We're opening more of the platform to other organizations. If your team is wrestling with similar questions, we'd love to hear from you.</p>
          </div>
          <aside class="hidden lg:block">
            <div class="sticky top-24 rounded-2xl border border-border bg-card p-5">
              <h4 class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">Tags</h4>
              <div class="mt-3 flex flex-wrap gap-2">
                <Badge v-for="t in (post.tags ?? [])" :key="t" variant="muted">#{{ t }}</Badge>
              </div>
            </div>
          </aside>
        </div>
      </section>

      <section class="section-y border-t border-border bg-card/40">
        <div class="container-page">
          <SectionHeading title="Keep reading" />
          <div class="mt-10 grid gap-6 md:grid-cols-3">
            <PostCard v-for="p in related" :key="p.id" :post="p" />
          </div>
        </div>
      </section>

      <NewsletterSection />
    </article>

</template>
