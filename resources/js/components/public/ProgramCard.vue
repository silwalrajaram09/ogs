<script setup lang="ts">
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { Calendar, MapPin, ArrowRight } from "lucide-vue-next";
import { Card, CardContent } from "@/components/public/ui/card";
import { Badge } from "@/components/ui/badge";
import { formatDate } from "@/lib/utils";
import type { Program } from "@/types/public";

const props = defineProps<{ program: Program }>();
const statusVariant = computed(() => ({
  upcoming: "warning",
  active: "success",
  completed: "muted",
}[props.program.status] as "warning" | "success" | "muted"));
</script>

<template>
  <Link :href="`/programs/${program.slug}`" class="group block h-full">
    <Card class="h-full overflow-hidden border-border/70 transition-all duration-300 hover:-translate-y-1 hover:border-brand/40 hover:shadow-[var(--shadow-elevated)]">
      <div class="relative aspect-[16/9] overflow-hidden bg-[var(--gradient-brand)]">
        <div class="absolute inset-0 opacity-30" style="background:radial-gradient(circle at 30% 30%, rgba(255,255,255,0.4), transparent 50%)" />
        <div class="absolute left-4 top-4 flex gap-2">
          <Badge variant="brand" class="bg-background/90 backdrop-blur">{{ program.category }}</Badge>
          <Badge :variant="statusVariant" class="capitalize bg-background/90 backdrop-blur">{{ program.status }}</Badge>
        </div>
      </div>
      <CardContent class="p-6">
        <h3 class="text-lg font-semibold text-foreground transition-colors group-hover:text-brand">{{ program.title }}</h3>
        <p class="mt-2 line-clamp-2 text-sm text-muted-foreground text-pretty">{{ program.excerpt }}</p>
        <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-muted-foreground">
          <span class="inline-flex items-center gap-1.5"><Calendar class="size-3.5" />{{ formatDate(program.startDate) }}</span>
          <span v-if="program.location" class="inline-flex items-center gap-1.5"><MapPin class="size-3.5" />{{ program.location }}</span>
        </div>
        <div class="mt-5 inline-flex items-center gap-1.5 text-sm font-medium text-brand">
          Learn more <ArrowRight class="size-3.5 transition-transform group-hover:translate-x-0.5" />
        </div>
      </CardContent>
    </Card>
  </Link>
</template>
