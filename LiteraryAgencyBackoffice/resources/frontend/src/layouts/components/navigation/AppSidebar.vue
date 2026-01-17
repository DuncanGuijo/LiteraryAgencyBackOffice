<template>
  <aside class="sidebar">
    <div class="sidebar-logo">
      <span>📚 MyApp</span>
    </div>

    <nav class="sidebar-nav">
      <div
        v-for="section in sections"
        :key="section.title"
        class="sidebar-section"
      >
        <p class="sidebar-section-title">{{ section.title }}</p>

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
      { label: 'Books', route: '/books' },
      { label: 'Agencies', route: '/agencies' },
      { label: 'Genres', route: '/genres' },
    ],
  },
]
</script>

<style scoped>
.sidebar {
  width: 240px;
  background: #111;
  color: #fff;
  height: 100vh;
  display: flex;
  flex-direction: column;
}

.sidebar-logo {
  padding: 16px;
  font-weight: bold;
  border-bottom: 1px solid #222;
}

.sidebar-nav {
  padding: 12px;
}

.sidebar-section-title {
  font-size: 12px;
  text-transform: uppercase;
  opacity: 0.6;
  margin: 12px 0 6px;
}
</style>
