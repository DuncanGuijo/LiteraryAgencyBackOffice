<template>
  <header class="app-navbar flex items-center justify-between px-6 h-14 bg-white border-b border-slate-200 shadow-sm">
    <div class="text-xl font-semibold text-gray-800">
      Dashboard
    </div>

    <div class="flex items-center space-x-4">
      <div class="relative">
        <input
          type="text"
          placeholder="Search..."
          class="pl-10 pr-4 py-2.5 w-124 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition"
        />
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
        </svg>
      </div>

      <UserAvatar />
    </div>
  </header>
</template>

<script setup lang="ts">
import UserAvatar from '@/layouts/components/user/UserAvatar.vue';
</script>
