<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Users, ArrowUpRight, GitBranch } from "lucide-vue-next";
import { Badge } from "@/components/public/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import type { Committee } from "@/types/public";

defineProps<{ committee: Committee }>();
</script>

<template>
  <Link :href="`/committees/${committee.slug}`" class="group block h-full">
    <Card class="h-full overflow-hidden border-border/70 transition-all duration-300 hover:-translate-y-1 hover:border-brand/40 hover:shadow-[var(--shadow-elevated)]">
      <CardContent class="flex h-full flex-col gap-4 p-6">
        <div class="flex items-start justify-between gap-3">
          <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-brand-soft text-brand">
            <GitBranch class="size-5" />
          </span>
          <Badge v-if="committee.category" variant="brand">{{ committee.category }}</Badge>
        </div>
        <div class="min-w-0">
          <h3 class="text-lg font-semibold text-foreground transition-colors group-hover:text-brand">{{ committee.name }}</h3>
          <p class="mt-1.5 line-clamp-2 text-sm text-muted-foreground text-pretty">{{ committee.description }}</p>
        </div>
        <div class="mt-auto flex items-center justify-between pt-2 text-sm text-muted-foreground">
          <span class="inline-flex items-center gap-1.5"><Users class="size-4" /> {{ committee.memberCount }} members</span>
          <ArrowUpRight class="size-4 transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-brand" />
        </div>
      </CardContent>
    </Card>
  </Link>
</template>
