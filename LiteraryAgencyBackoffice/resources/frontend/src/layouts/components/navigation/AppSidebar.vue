<template>
  <aside class="app-sidebar">
    <div>
      <span>📚 MyApp</span>
    </div>

    <nav>
      <div
        v-for="section in sections"
        :key="section.title"
        
      >
        <p>{{ section.title }}</p>

        <SidebarItem
          v-for="item in section.items"
          :key="item.route"
          :item="item"
        />
      </div>
    </nav>
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