<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import { demoStats } from "@/composables/useDemoData";

const stats = ref(demoStats.map(s => ({ ...s, display: 0 })));
const animated = ref(false);
let observer: IntersectionObserver | null = null;
const root = ref<HTMLElement | null>(null);

const animate = () => {
  if (animated.value){

    return;
  }

  animated.value = true;
  const duration = 1600;
  const start = performance.now();
  const tick = (now: number) => {
    const t = Math.min(1, (now - start) / duration);
    const ease = 1 - Math.pow(1 - t, 3);
    stats.value = stats.value.map((s, i) => ({ ...s, display: Math.round(demoStats[i].value * ease) }));

    if (t < 1) {

      requestAnimationFrame(tick);
    }
  };
  requestAnimationFrame(tick);
};

onMounted(() => {
  if (!root.value) {
    return;
  }
  
  observer = new IntersectionObserver(es => es.forEach(e => e.isIntersecting && animate()), { threshold: 0.3 });
  observer.observe(root.value);
});
onUnmounted(() => observer?.disconnect());

const fmt = (n: number) => n.toLocaleString("en-US");
</script>

<template>
  <section ref="root" class="section-y relative overflow-hidden border-y border-border bg-card/40">
    <div class="container-page">
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <div v-for="s in stats" :key="s.label" class="text-center sm:text-left">
          <div class="font-display text-4xl text-foreground md:text-6xl">
            <span class="brand-grad-text">{{ fmt(s.display) }}+</span>
          </div>
          <p class="mt-2 text-sm font-medium uppercase tracking-wider text-muted-foreground">{{ s.label }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
