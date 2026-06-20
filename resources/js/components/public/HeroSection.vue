<script setup lang="ts">
import { ArrowRight, Sparkles } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
</script>

<template>
  <section class="relative overflow-hidden hero-grad">
    <div class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-32 top-10 size-80 rounded-full bg-brand/20 blur-3xl" />
      <div class="absolute right-0 top-40 size-96 rounded-full bg-fuchsia-400/10 blur-3xl" />
    </div>

    <div class="container-page relative pb-20 pt-16 md:pb-32 md:pt-24">
      <div class="mx-auto max-w-3xl text-center">
        <span class="inline-flex items-center gap-2 rounded-full border border-border bg-background/70 px-3.5 py-1.5 text-xs font-medium text-muted-foreground backdrop-blur animate-fade-up">
          <Sparkles class="size-3.5 text-brand" />
          Building trusted communities since 2014
        </span>
        <h1 class="mt-6 font-display text-4xl text-foreground text-balance md:text-7xl animate-fade-up">
          The operating system for
          <span class="brand-grad-text">global communities</span>
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-base text-muted-foreground text-pretty md:text-xl animate-fade-up">
          UnitySphere helps organizations run committees, programs, and member networks with the clarity and care they deserve — across 47 countries and counting.
        </p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-3 animate-fade-up">
          <Button as="a" href="/register" variant="brand" size="lg">
            Become a member
            <ArrowRight class="size-4" />
          </Button>
          <Button as="a" href="/about" variant="outline" size="lg">Our mission</Button>
        </div>

        <div class="mx-auto mt-14 flex max-w-md flex-wrap items-center justify-center gap-x-8 gap-y-2 text-xs text-muted-foreground">
          <span>Trusted by</span>
          <span class="font-semibold tracking-wide text-foreground/70">UNESCO</span>
          <span class="font-semibold tracking-wide text-foreground/70">Open Society</span>
          <span class="font-semibold tracking-wide text-foreground/70">Rotary Intl.</span>
          <span class="font-semibold tracking-wide text-foreground/70">Mozilla</span>
        </div>
      </div>
    </div>
  </section>
</template>
