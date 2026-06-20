<script setup lang="ts">
import Footer from "@/components/public/Footer.vue";
import Navbar from "@/components/public/Navbar.vue";
</script>

<template>
  <div class="flex min-h-screen flex-col bg-background text-foreground p-5">
    <Navbar />
    <main class="flex-1 p-5">
      <slot />
    </main>
    <Footer />
  </div>
</template>
