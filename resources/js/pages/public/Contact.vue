<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { MapPin, Mail, Phone, Twitter, Linkedin, Github } from "lucide-vue-next";
import PublicLayout from "@/layouts/PublicLayout.vue";
import SectionHeading from "@/components/public/SectionHeading.vue";
import ContactForm from "@/components/public/ContactForm.vue";
import { Accordion, AccordionItem } from "@/components/public/ui/accordion";

defineOptions({ layout: null });

const offices = [
  { city: "Geneva", country: "Switzerland", address: "12 Rue du Conseil-Général, 1205", role: "Headquarters" },
  { city: "Nairobi", country: "Kenya", address: "Westlands, Mpaka Road, Suite 4A", role: "East Africa hub" },
  { city: "Singapore", country: "Singapore", address: "1 Raffles Place, Tower 2, #20-01", role: "Asia-Pacific hub" },
];

const faqs = [
  { q: "How do I join UnitySphere?", a: "Membership is open to individuals affiliated with a registered chapter or partner organization. Visit the Join page to start the application." },
  { q: "Is the platform open source?", a: "The community edition is open source under an MIT-compatible license. Enterprise features and managed hosting are commercial." },
  { q: "Do you offer chapter onboarding support?", a: "Yes — every new chapter receives a dedicated success partner for the first 90 days, plus access to our governance playbook." },
  { q: "How is member data protected?", a: "We follow ISO 27001-aligned practices, encrypt all data at rest and in transit, and never sell member information. Full details in our privacy policy." },
  { q: "Can we run UnitySphere on our own infrastructure?", a: "Yes — self-hosting is supported for the community edition. Enterprise customers can also request a private cloud deployment." },
];
</script>

<template>
  <Head>
    <title>Contact UnitySphere — Talk to our team</title>
    <meta name="description" content="Get in touch with UnitySphere about partnerships, membership, press, or anything else. Three offices, one team, real humans." />
  </Head>

  
    <section class="hero-grad section-y border-b border-border">
      <div class="container-page">
        <div class="mx-auto max-w-3xl text-center">
          <span class="inline-flex items-center rounded-full border border-border bg-background/70 px-3 py-1 text-xs font-medium text-muted-foreground">Contact</span>
          <h1 class="mt-5 font-display text-4xl text-balance md:text-6xl">Let's talk.</h1>
          <p class="mx-auto mt-5 max-w-2xl text-base text-muted-foreground text-pretty md:text-lg">
            Partnership, press, membership, or general curiosity — we read every message.
          </p>
        </div>
      </div>
    </section>

    <section class="section-y">
      <div class="container-page grid gap-12 lg:grid-cols-[1.2fr_1fr]">
        <div class="rounded-3xl border border-border bg-card p-8 md:p-10">
          <h2 class="font-display text-2xl md:text-3xl">Send us a message</h2>
          <p class="mt-2 text-sm text-muted-foreground">We typically respond within two business days.</p>
          <div class="mt-8"><ContactForm /></div>
        </div>

        <div class="space-y-6">
          <div class="rounded-3xl border border-border bg-card p-8">
            <h3 class="font-display text-xl">Reach us directly</h3>
            <ul class="mt-6 space-y-4 text-sm">
              <li class="flex items-start gap-3"><Mail class="mt-0.5 size-4 text-brand" /><span><strong class="font-semibold">hello@unitysphere.org</strong><br /><span class="text-muted-foreground">General inquiries</span></span></li>
              <li class="flex items-start gap-3"><Mail class="mt-0.5 size-4 text-brand" /><span><strong class="font-semibold">press@unitysphere.org</strong><br /><span class="text-muted-foreground">Media & press</span></span></li>
              <li class="flex items-start gap-3"><Phone class="mt-0.5 size-4 text-brand" /><span><strong class="font-semibold">+41 22 555 0140</strong><br /><span class="text-muted-foreground">Mon–Fri, 09:00–17:00 CET</span></span></li>
            </ul>
            <div class="mt-6 flex gap-2 border-t border-border pt-6">
              <a v-for="s in [{i: Twitter, l: 'Twitter'},{i: Linkedin, l: 'LinkedIn'},{i: Github, l: 'GitHub'}]" :key="s.l"
                href="#" :aria-label="s.l"
                class="grid size-9 place-items-center rounded-md border border-border text-muted-foreground hover:border-brand hover:text-brand">
                <component :is="s.i" class="size-4" />
              </a>
            </div>
          </div>
          <div class="overflow-hidden rounded-3xl border border-border bg-card">
            <div class="relative aspect-[4/3] w-full bg-[var(--gradient-brand)]">
              <div class="absolute inset-0 opacity-30" style="background:radial-gradient(circle at 50% 50%, rgba(255,255,255,0.4), transparent 50%)" />
              <div class="absolute inset-0 grid place-items-center text-brand-foreground">
                <div class="text-center">
                  <MapPin class="mx-auto size-8" />
                  <p class="mt-2 font-display text-xl">Find us in Geneva</p>
                </div>
              </div>
            </div>
            <div class="p-5 text-sm text-muted-foreground">12 Rue du Conseil-Général, 1205 Geneva, Switzerland</div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-y border-t border-border bg-card/40">
      <div class="container-page">
        <SectionHeading eyebrow="Our offices" title="Three hubs, one team" />
        <div class="mt-12 grid gap-6 md:grid-cols-3">
          <div v-for="o in offices" :key="o.city" class="rounded-2xl border border-border bg-card p-6">
            <span class="text-xs font-semibold uppercase tracking-wider text-brand">{{ o.role }}</span>
            <h3 class="mt-2 font-display text-2xl">{{ o.city }}</h3>
            <p class="text-sm text-muted-foreground">{{ o.country }}</p>
            <p class="mt-3 flex items-start gap-2 text-sm text-muted-foreground"><MapPin class="mt-0.5 size-4 shrink-0 text-brand" /> {{ o.address }}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section-y">
      <div class="container-page max-w-3xl">
        <SectionHeading align="center" eyebrow="FAQ" title="Common questions" />
        <Accordion class="mt-10">
          <AccordionItem v-for="(f, i) in faqs" :key="i" :id="String(i)" :question="f.q">{{ f.a }}</AccordionItem>
        </Accordion>
      </div>
    </section>

</template>
