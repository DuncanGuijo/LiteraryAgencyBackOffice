<template>
  <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-700 cursor-pointer">
    <img
      v-if="user?.avatarUrl"
      :src="user.avatarUrl"
      alt="User avatar"
      class="w-full h-full object-cover"
    />
    <div v-else>
      {{ initials }}
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

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
