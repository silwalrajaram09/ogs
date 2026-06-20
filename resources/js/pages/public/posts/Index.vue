<script setup lang="ts">
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";
import { Search } from "lucide-vue-next";
import PublicLayout from "@/layouts/PublicLayout.vue";
import SectionHeading from "@/components/public/SectionHeading.vue";
import PostCard from "@/components/public/PostCard.vue";
import Breadcrumbs from "@/components/public/Breadcrumbs.vue";
import NewsletterSection from "@/components/public/NewsletterSection.vue";
import { Input } from "@/components/ui/input";
import { demoPosts } from "@/composables/useDemoData";
import type { Post } from "@/types/public";

const props = defineProps<{ posts?: Post[] }>();
defineOptions({ layout: null });

const data = computed(() => props.posts ?? demoPosts);
const activeCategory = ref<string>("All");
const search = ref("");

const categories = computed(() => ["All", ...new Set(data.value.map(p => p.category))]);
const filtered = computed(() => data.value.filter(p =>
  (activeCategory.value === "All" || p.category === activeCategory.value) &&
  (!search.value || p.title.toLowerCase().includes(search.value.toLowerCase()))
));
const featured = computed(() => data.value[0]);
const rest = computed(() => filtered.value.filter(p => p.id !== featured.value.id));
</script>

<template>
  <Head>
    <title>Blog — UnitySphere</title>
    <meta name="description" content="Field notes, playbooks, research, and stories from the UnitySphere network." />
  </Head>

  
    <section class="hero-grad border-b border-border pb-12 pt-16">
      <div class="container-page">
        <Breadcrumbs :items="[{ label: 'Blog' }]" />
        <div class="mt-6 flex flex-wrap items-end justify-between gap-6">
          <div class="max-w-2xl">
            <h1 class="font-display text-4xl text-balance md:text-5xl">From the field</h1>
            <p class="mt-3 text-base text-muted-foreground text-pretty md:text-lg">Stories, research, and tools from across the UnitySphere network.</p>
          </div>
          <div class="relative w-full max-w-sm">
            <Search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground" />
            <Input v-model="search" placeholder="Search articles..." class="pl-9" />
          </div>
        </div>
      </div>
    </section>

    <section class="pt-12">
      <div class="container-page">
        <PostCard :post="featured" featured />
      </div>
    </section>

    <section class="pt-10">
      <div class="container-page">
        <div class="flex flex-wrap items-center gap-2">
          <button v-for="c in categories" :key="c" @click="activeCategory = c"
            :class="['rounded-full px-3 py-1.5 text-xs font-medium transition-colors', activeCategory === c ? 'bg-brand text-brand-foreground' : 'bg-secondary text-secondary-foreground hover:bg-accent']">
            {{ c }}
          </button>
        </div>
      </div>
    </section>

    <section class="section-y pt-10">
      <div class="container-page">
        <div v-if="rest.length" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          <PostCard v-for="p in rest" :key="p.id" :post="p" />
        </div>
        <div v-else class="rounded-2xl border border-dashed border-border bg-card p-16 text-center">
          <p class="text-sm text-muted-foreground">No articles match your search yet.</p>
        </div>
      </div>
    </section>

    <NewsletterSection />
  
</template>
