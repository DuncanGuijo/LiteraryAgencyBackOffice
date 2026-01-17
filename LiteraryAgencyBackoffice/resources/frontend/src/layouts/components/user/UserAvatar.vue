<template>
  <div class="user-avatar">
    <img
      v-if="user?.avatarUrl"
      :src="user.avatarUrl"
      alt="User avatar"
    />
    <div v-else class="avatar-placeholder">
      {{ initials }}
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

// ⚠️ Simulado por ahora
const user = {
  name: 'Duncan',
  avatarUrl: null,
}

const initials = computed(() =>
  user.name
    .split(' ')
    .map(n => n[0])
    .join('')
)
</script>

<style scoped>
.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  overflow: hidden;
  background: #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}
</style>
