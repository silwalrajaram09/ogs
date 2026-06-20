<script setup lang="ts">
import { cn } from "@/lib/utils";
import { cva, type VariantProps } from "class-variance-authority";
const badgeVariants = cva(
  "inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium transition-colors",
  {
    variants: {
      variant: {
        default: "border-transparent bg-secondary text-secondary-foreground",
        brand: "border-transparent bg-brand-soft text-brand",
        outline: "text-foreground",
        success: "border-transparent bg-emerald-500/10 text-emerald-700 dark:text-emerald-300",
        warning: "border-transparent bg-amber-500/10 text-amber-700 dark:text-amber-300",
        muted: "border-transparent bg-muted text-muted-foreground",
      },
    },
    defaultVariants: { variant: "default" },
  },
);
type BadgeProps = VariantProps<typeof badgeVariants>;
defineProps<{ variant?: BadgeProps["variant"]; class?: string }>();
</script>
<template>
  <span :class="cn(badgeVariants({ variant }), $props.class)"><slot /></span>
</template>
