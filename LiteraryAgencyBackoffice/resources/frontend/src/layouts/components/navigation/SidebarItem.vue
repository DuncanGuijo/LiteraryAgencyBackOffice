<template>
  <router-link
    :to="item.route"
    class="sidebar-item"
    :class="{ active: isActive }"
  >
    {{ item.label }}
  </router-link>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const props = defineProps<{
  item: {
    label: string
    route: string
  }
}>()

const route = useRoute()

const isActive = computed(() =>
  route.path.startsWith(props.item.route)
)
</script>

<style scoped>
.sidebar-item {
  display: block;
  padding: 8px 12px;
  border-radius: 6px;
  color: #ddd;
  text-decoration: none;
}

.sidebar-item:hover {
  background: #222;
}

.sidebar-item.active {
  background: #333;
  font-weight: 600;
}
</style>
