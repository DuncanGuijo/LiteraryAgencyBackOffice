<template>
  <aside class="app-sidebar flex flex-col w-64 bg-slate-900 text-slate-100 h-screen shadow-lg">
    <router-link to="/" class="px-6 py-4 text-2xl font-bold text-indigo-400 flex items-center gap-2">
      <span>📚</span>
      <span>MyApp</span>
    </router-link>

    <nav class="flex-1 overflow-y-auto mt-4">
      <div
        v-for="section in sections"
        :key="section.title"
        class="mb-6"
      >
        <p class="px-6 py-2 text-sm font-semibold text-gray-400 uppercase tracking-wide">
          {{ section.title }}
        </p>

        <div class="flex flex-col">
          <SidebarItem
            v-for="item in section.items"
            :key="item.route"
            :item="item"
            class="hover:bg-indigo-700 rounded-r-lg transition-colors"
          />
        </div>
      </div>
    </nav>

    <div class="px-6 py-4 text-xs text-gray-500 border-t border-gray-700">
      Version 1.0.0
    </div>
  </aside>
</template>

<script setup lang="ts">
import SidebarItem from './SidebarItem.vue'

const sections = [
  {
    title: 'Management',
    items: [
      { label: 'Agencies', route: '/agencies' },
      { label: 'Authors', route: '/authors' },
      { label: 'Books', route: '/books' },
      { label: 'Genres', route: '/genres' },
    ],
  },
]
</script>
