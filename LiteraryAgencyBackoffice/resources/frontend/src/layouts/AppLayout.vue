<template>
  <div class="app-layout">
    <AppSidebar />

    <div class="app-main">
      <AppNavbar />
      <main class="app-content">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import AppSidebar from '@/layouts/components/navigation/AppSidebar.vue'
import AppNavbar from '@/layouts/components/navigation/AppNavbar.vue'
</script>
