<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Clock, ArrowUpRight } from "lucide-vue-next";
import { Badge } from "@/components/public/ui/badge";
import { formatDate } from "@/lib/utils";
import type { Post } from "@/types/public";

withDefaults(defineProps<{ post: Post; featured?: boolean }>(), { featured: false });
</script>

<template>
  <Link :href="`/posts/${post.slug}`" class="group block h-full">
    <article
      :class="[
        'flex h-full flex-col overflow-hidden rounded-2xl border border-border/70 bg-card transition-all duration-300 hover:-translate-y-1 hover:border-brand/40 hover:shadow-[var(--shadow-elevated)]',
        featured && 'md:flex-row'
      ]"
    >
      <div
        :class="[
          'relative aspect-[16/10] shrink-0 overflow-hidden bg-gradient-to-br from-brand/30 via-fuchsia-400/15 to-amber-300/15',
          featured && 'md:aspect-auto md:w-1/2'
        ]"
      >
        <div class="absolute inset-0 opacity-50" style="background:radial-gradient(circle at 70% 30%, rgba(255,255,255,0.3), transparent 60%)" />
        <Badge variant="brand" class="absolute left-4 top-4 bg-background/90 backdrop-blur">{{ post.category }}</Badge>
      </div>
      <div class="flex flex-1 flex-col gap-3 p-6 md:p-7">
        <div class="flex items-center gap-3 text-xs text-muted-foreground">
          <span>{{ formatDate(post.publishedAt) }}</span>
          <span class="size-1 rounded-full bg-border" />
          <span class="inline-flex items-center gap-1"><Clock class="size-3" />{{ post.readMinutes }} min read</span>
        </div>
        <h3 :class="['font-semibold text-foreground transition-colors group-hover:text-brand text-balance', featured ? 'text-2xl md:text-3xl font-display' : 'text-lg']">
          {{ post.title }}
        </h3>
        <p :class="['line-clamp-3 text-muted-foreground text-pretty', featured ? 'text-base' : 'text-sm']">{{ post.excerpt }}</p>
        <div class="mt-auto flex items-center justify-between pt-4">
          <div class="flex items-center gap-2.5">
            <span class="grid size-8 place-items-center rounded-full bg-[var(--gradient-brand)] text-xs font-semibold text-brand-foreground">
              {{ post.author.name.split(' ').map(p => p[0]).slice(0,2).join('') }}
            </span>
            <div class="min-w-0">
              <p class="truncate text-sm font-medium text-foreground">{{ post.author.name }}</p>
              <p v-if="post.author.role" class="truncate text-xs text-muted-foreground">{{ post.author.role }}</p>
            </div>
          </div>
          <ArrowUpRight class="size-4 text-muted-foreground transition-all group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-brand" />
        </div>
      </div>
    </article>
  </Link>
</template>
