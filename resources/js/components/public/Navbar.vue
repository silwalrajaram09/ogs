<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Menu, X, Globe2, Moon, Sun } from "lucide-vue-next";
import { ref, onMounted, onUnmounted } from "vue";
import MobileMenu from "@/components/public/MobileMenu.vue";
import { Button } from "@/components/public/ui/button";
import { useTheme } from "@/composables/useTheme";
import type { NavLink } from "@/types/public";

const links: NavLink[] = [
  { label: "About", href: "/about" },
  { label: "Committees", href: "/committees" },
  { label: "Programs", href: "/programs" },
  { label: "Blog", href: "/posts" },
  { label: "Contact", href: "/contact" },
];

const scrolled = ref(false);
const mobileOpen = ref(false);
const { isDark, toggle } = useTheme();

const onScroll = () => (scrolled.value = window.scrollY > 8);
onMounted(() => { 
  onScroll(); window.addEventListener("scroll", onScroll, { passive: true }); 
});
onUnmounted(() => window.removeEventListener("scroll", onScroll));
</script>

<template>
  <header
    :class="[
      'sticky top-0 z-50 w-full transition-all duration-300',
      scrolled
        ? 'border-b border-border/60 bg-background/80 backdrop-blur-xl supports-[backdrop-filter]:bg-background/60'
        : 'bg-transparent'
    ]"
  >
    <div class="container-page flex h-16 items-center justify-between gap-4 md:h-20">
      <Link href="/" class="group flex items-center gap-2.5">
        <span class="grid size-9 place-items-center rounded-lg bg-[var(--gradient-brand)] text-brand-foreground shadow-[var(--shadow-glow)] transition-transform group-hover:scale-105">
          <Globe2 class="size-5" />
        </span>
        <span class="font-display text-xl tracking-tight">UnitySphere</span>
      </Link>

      <nav class="hidden items-center gap-1 md:flex">
        <Link
          v-for="link in links" :key="link.href" :href="link.href"
          class="rounded-md px-3 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
        >
          {{ link.label }}
        </Link>
      </nav>

      <div class="flex items-center gap-2">
        <button
          @click="toggle" type="button" aria-label="Toggle theme"
          class="hidden size-9 items-center justify-center rounded-md text-muted-foreground hover:bg-accent hover:text-foreground md:inline-flex"
        >
          <Sun v-if="isDark" class="size-4" />
          <Moon v-else class="size-4" />
        </button>
        <Button as="a" href="/login" variant="ghost" size="sm" class="hidden sm:inline-flex">Sign in</Button>
        <Button as="a" href="/register" variant="brand" size="sm" class="hidden sm:inline-flex">Join us</Button>
        <button
          @click="mobileOpen = true" type="button" aria-label="Open menu"
          class="inline-flex size-10 items-center justify-center rounded-md text-foreground hover:bg-accent md:hidden"
        >
          <Menu class="size-5" />
        </button>
      </div>
    </div>

    <MobileMenu v-model:open="mobileOpen" :links="links" />
  </header>
</template>
