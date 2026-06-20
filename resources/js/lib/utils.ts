import type { InertiaLinkProps } from '@inertiajs/vue3';
import { clsx } from 'clsx';
import type { ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function toUrl(href: NonNullable<InertiaLinkProps['href']>) {
    return typeof href === 'string' ? href : href?.url;
}
export function formatDate(d: string | Date) {
  const date = typeof d === "string" ? new Date(d) : d;
  
  return date.toLocaleDateString("en-US", { year: "numeric", month: "short", day: "numeric" });
}
