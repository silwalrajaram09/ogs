<script setup lang="ts">
import { ref } from "vue";
import { Send, Check } from "lucide-vue-next";
import { Button } from "@/components/public/ui/button";
import { Input } from "@/components/public/ui/input";

const form = ref({ name: "", email: "", organization: "", topic: "general", message: "" });
const sent = ref(false);
const loading = ref(false);

const submit = async () => {
  loading.value = true;
  // Replace with: router.post(route('contact.store'), form.value, { onFinish: () => loading.value = false })
  await new Promise(r => setTimeout(r, 700));
  loading.value = false;
  sent.value = true;
};
</script>

<template>
  <form v-if="!sent" @submit.prevent="submit" class="space-y-5">
    <div class="grid gap-5 sm:grid-cols-2">
      <div>
        <label class="mb-1.5 block text-sm font-medium text-foreground">Name</label>
        <Input v-model="form.name" placeholder="Your full name" required />
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-medium text-foreground">Email</label>
        <Input v-model="form.email" type="email" placeholder="you@org.com" required />
      </div>
    </div>
    <div>
      <label class="mb-1.5 block text-sm font-medium text-foreground">Organization</label>
      <Input v-model="form.organization" placeholder="Where do you work?" />
    </div>
    <div>
      <label class="mb-1.5 block text-sm font-medium text-foreground">What's this about?</label>
      <select v-model="form.topic" class="flex h-11 w-full rounded-md border border-input bg-background px-4 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
        <option value="general">General inquiry</option>
        <option value="partnership">Partnership</option>
        <option value="press">Press</option>
        <option value="membership">Membership</option>
      </select>
    </div>
    <div>
      <label class="mb-1.5 block text-sm font-medium text-foreground">Message</label>
      <textarea v-model="form.message" rows="5" required placeholder="Tell us a bit more..."
        class="flex w-full rounded-md border border-input bg-background px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring" />
    </div>
    <Button type="submit" variant="brand" size="lg" :disabled="loading">
      <Send class="size-4" /> {{ loading ? "Sending..." : "Send message" }}
    </Button>
  </form>
  <div v-else class="flex flex-col items-center justify-center rounded-2xl border border-emerald-500/30 bg-emerald-500/5 p-10 text-center">
    <span class="grid size-12 place-items-center rounded-full bg-emerald-500 text-white"><Check class="size-6" /></span>
    <h3 class="mt-4 font-display text-2xl">Message received</h3>
    <p class="mt-2 max-w-sm text-sm text-muted-foreground">Thank you — a member of our team will get back to you within two business days.</p>
  </div>
</template>
