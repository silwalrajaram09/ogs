<script setup lang="ts">
import { Quote } from "lucide-vue-next";
import { Card, CardContent } from "@/components/public/ui/card";
import { demoTestimonials } from "@/composables/useDemoData";
import SectionHeading from "./SectionHeading.vue";
</script>

<template>
  <section class="section-y">
    <div class="container-page">
      <SectionHeading
        eyebrow="Member voices" title="What community leaders are saying"
        description="Quotes from chapter leads and coordinators using UnitySphere every day." align="center"
      />
      <div class="mt-14 grid gap-6 md:grid-cols-3">
        <Card v-for="t in demoTestimonials" :key="t.id" class="relative border-border/70 transition-all hover:-translate-y-1 hover:shadow-[var(--shadow-elevated)]">
          <CardContent class="flex h-full flex-col p-7">
            <Quote class="size-7 text-brand/70" />
            <p class="mt-4 flex-1 text-base text-foreground text-pretty leading-relaxed">"{{ t.quote }}"</p>
            <div class="mt-6 flex items-center gap-3 border-t border-border pt-5">
              <span class="grid size-10 place-items-center rounded-full bg-[var(--gradient-brand)] text-sm font-semibold text-brand-foreground">
                {{ t.name.split(' ').map(p => p[0]).slice(0,2).join('') }}
              </span>
              <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-foreground">{{ t.name }}</p>
                <p class="truncate text-xs text-muted-foreground">{{ t.role }}</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  </section>
</template>
