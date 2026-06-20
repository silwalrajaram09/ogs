<script setup lang="ts">
defineProps<{
  committees: any
  auth_user: any
}>()
defineOptions({
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: '/my-committees',
        },
    ],
})
</script>

<template>
  <div class="min-h-screen bg-gray-50 p-8">

    <!-- Header -->
    <div class="mb-8">
      <p class="text-sm font-medium text-gray-400 uppercase tracking-widest mb-1">Dashboard</p>
      <h1 class="text-3xl font-semibold text-gray-900">
        Welcome back, {{ auth_user.full_name }}
      </h1>
    </div>

    <!-- Section title -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Committees</h2>
      <span class="text-xs text-gray-400">{{ committees.length }} total</span>
    </div>

    <!-- Committee cards -->
    <div class="space-y-3">
      <div
        v-for="committee in committees"
        :key="committee.id"
        class="bg-white border border-gray-100 rounded-xl px-5 py-4 shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-200 group"
      >
        <!-- Top row -->
        <div class="flex items-start justify-between">
          <div class="flex items-center gap-3">
            <!-- Avatar initial -->
            <div class="w-9 h-9 rounded-lg bg-gray-900 text-white flex items-center justify-center text-sm font-semibold flex-shrink-0">
              {{ committee.name.charAt(0).toUpperCase() }}
            </div>
            <div>
              <h3 class="text-sm font-semibold text-gray-900 group-hover:text-black transition-colors">
                {{ committee.name }}
              </h3>
              <p v-if="committee.parent" class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                {{ committee.parent.name }}
              </p>
              <p v-else class="text-xs text-gray-400 mt-0.5">Root committee</p>
            </div>
          </div>

          <!-- Badge -->
          <span
            class="text-xs px-2.5 py-1 rounded-full font-medium"
            :class="committee.parent
              ? 'bg-gray-100 text-gray-500'
              : 'bg-gray-900 text-white'"
          >
            {{ committee.parent ? 'Sub' : 'Root' }}
          </span>
        </div>
      </div>
    </div>

    <!-- Empty state -->
    <div v-if="!committees.length" class="text-center py-16 text-gray-400">
      <p class="text-sm">No committees found.</p>
    </div>

  </div>
</template>