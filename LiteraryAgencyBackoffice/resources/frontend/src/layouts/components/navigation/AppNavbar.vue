<template>
  <header class="navbar">
    <div class="navbar-left">
      <h1 class="navbar-title">Dashboard</h1>
    </div>

    <div class="navbar-right">
      <!-- <UserAvatar /> -->
    </div>
  </header>
</template>

<script setup lang="ts">
/* import UserAvatar from '@/components/user/UserAvatar.vue'
 */
</script>

<style scoped>
.navbar {
  height: 56px;
  background: #fff;
  border-bottom: 1px solid #eee;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 16px;
}

.navbar-title {
  font-size: 16px;
  font-weight: 600;
}
</style>
