<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ArrowRight } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
import SectionHeading from "./SectionHeading.vue";
import PostCard from "./PostCard.vue";
import { demoPosts } from "@/composables/useDemoData";
import type { Post } from "@/types/public";

defineProps<{ posts?: Post[] }>();
</script>

<template>
  <section class="section-y">
    <div class="container-page">
      <div class="flex flex-wrap items-end justify-between gap-6">
        <SectionHeading
          eyebrow="From the blog" title="Latest stories & research"
          description="Field notes, playbooks, and reports from across the UnitySphere network."
        />
        <Button as-child variant="outline">
          <Link href="/posts">Visit blog <ArrowRight class="size-4" /></Link>
        </Button>
      </div>
      <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <PostCard v-for="p in (posts ?? demoPosts).slice(0, 3)" :key="p.id" :post="p" />
      </div>
    </div>
  </section>
</template>
