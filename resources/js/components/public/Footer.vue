<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Globe2, Twitter, Linkedin, Github, Instagram, Mail } from "lucide-vue-next";

const columns = [
  { title: "Platform", links: [
    { label: "About", href: "/about" },
    { label: "Committees", href: "/committees" },
    { label: "Programs", href: "/programs" },
    { label: "Blog", href: "/posts" },
  ]},
  { title: "Community", links: [
    { label: "Join us", href: "/register" },
    { label: "Member sign in", href: "/login" },
    { label: "Contact", href: "/contact" },
    { label: "Partners", href: "/about#partners" },
  ]},
  { title: "Resources", links: [
    { label: "Annual report", href: "/posts" },
    { label: "Press", href: "/contact" },
    { label: "Brand kit", href: "#" },
    { label: "Code of conduct", href: "#" },
  ]},
];

const socials = [
  { icon: Twitter, href: "#", label: "Twitter" },
  { icon: Linkedin, href: "#", label: "LinkedIn" },
  { icon: Github, href: "#", label: "GitHub" },
  { icon: Instagram, href: "#", label: "Instagram" },
];
</script>

<template>
  <footer class="border-t border-border bg-card/40">
    <div class="container-page py-16">
      <div class="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
        <div>
          <Link href="/" class="flex items-center gap-2.5">
            <span class="grid size-9 place-items-center rounded-lg bg-[var(--gradient-brand)] text-brand-foreground"><Globe2 class="size-5" /></span>
            <span class="font-display text-xl">UnitySphere</span>
          </Link>
          <p class="mt-4 max-w-sm text-sm text-muted-foreground text-pretty">
            A global community management platform for organizations that believe trust, transparency, and people are infrastructure.
          </p>
          <div class="mt-6 flex items-center gap-2">
            <a v-for="s in socials" :key="s.label" :href="s.href" :aria-label="s.label"
               class="grid size-9 place-items-center rounded-md border border-border text-muted-foreground transition-colors hover:border-brand hover:text-brand">
              <component :is="s.icon" class="size-4" />
            </a>
          </div>
        </div>

        <div v-for="col in columns" :key="col.title">
          <h4 class="text-sm font-semibold text-foreground">{{ col.title }}</h4>
          <ul class="mt-4 space-y-3">
            <li v-for="l in col.links" :key="l.label">
              <Link :href="l.href" class="text-sm text-muted-foreground transition-colors hover:text-foreground">{{ l.label }}</Link>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-12 flex flex-col items-start justify-between gap-4 border-t border-border pt-6 sm:flex-row sm:items-center">
        <p class="text-xs text-muted-foreground">© {{ new Date().getFullYear() }} UnitySphere. All rights reserved.</p>
        <div class="flex items-center gap-6 text-xs text-muted-foreground">
          <a href="#" class="hover:text-foreground">Privacy</a>
          <a href="#" class="hover:text-foreground">Terms</a>
          <a href="mailto:hello@unitysphere.org" class="inline-flex items-center gap-1.5 hover:text-foreground">
            <Mail class="size-3.5" /> hello@unitysphere.org
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>
