<template>
  <div class="pagination flex justify-end items-center mt-4 space-x-2">
    <button
      :disabled="meta.current_page <= 1"
      @click="$emit('prev')"
      class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-800 disabled:opacity-50 disabled:cursor-not-allowed transition shadow-sm"
    >
      Previous
    </button>

    <span class="text-gray-700 font-medium px-2">
      Page {{ meta.current_page }} of {{ meta.last_page }}
    </span>

    <button
      :disabled="meta.current_page >= meta.last_page"
      @click="$emit('next')"
      class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-800 disabled:opacity-50 disabled:cursor-not-allowed transition shadow-sm"
    >
      Next
    </button>
  </div>
</template>

<script setup lang="ts">

import type { Meta } from '@/shared/types/Pagination';

const props = defineProps<{
  meta: Meta
}>()

console.log('Pagination mounted', props)

defineEmits<{
  (e: 'next'): void
  (e: 'prev'): void
}>()

</script>
