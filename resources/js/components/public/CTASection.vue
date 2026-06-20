<script setup lang="ts">
import { ArrowRight } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
</script>

<template>
  <section class="section-y">
    <div class="container-page">
      <div class="relative overflow-hidden rounded-3xl border border-border bg-[var(--gradient-brand)] px-6 py-16 text-brand-foreground shadow-[var(--shadow-glow)] md:px-16 md:py-24">
        <div class="pointer-events-none absolute -right-20 -top-20 size-80 rounded-full bg-white/10 blur-3xl" />
        <div class="pointer-events-none absolute -bottom-24 -left-10 size-72 rounded-full bg-fuchsia-300/20 blur-3xl" />
        <div class="relative mx-auto max-w-2xl text-center">
          <h2 class="font-display text-3xl text-balance md:text-5xl">Ready to grow a community that lasts?</h2>
          <p class="mx-auto mt-4 max-w-xl text-base text-brand-foreground/85 text-pretty md:text-lg">
            Join UnitySphere today and get the tools, network, and playbook to scale your organization with intent.
          </p>
          <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <Button as="a" href="/register" size="lg" class="bg-background text-foreground hover:bg-background/90">
              Become a member <ArrowRight class="size-4" />
            </Button>
            <Button as="a" href="/contact" variant="outline" size="lg" class="border-white/30 bg-transparent text-brand-foreground hover:bg-white/10">
              Talk to our team
            </Button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
