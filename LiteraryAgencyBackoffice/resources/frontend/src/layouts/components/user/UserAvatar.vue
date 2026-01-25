<template>
  <div class="relative">
    <div
      @click="toggleDropdown"
      class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-700 cursor-pointer hover:ring-2 hover:ring-indigo-400 transition"
    >
      <img
        v-if="user?.avatarFile"
        :src="user.avatarFile"
        alt="User avatar"
        class="w-full h-full object-cover"
      />
      <div v-else>
        {{ initials }}
      </div>
    </div>

    <transition name="fade">
      <div
        v-if="dropdownOpen"
        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50"
      >
        <div class="py-2">
          <button
            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center gap-2"
            @click="editProfile"
          >
            Edit Profile
          </button>
          <button
            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center gap-2"
            @click="logout"
          >
            Logout
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth.store'

const auth = useAuthStore()
const router = useRouter()
const dropdownOpen = ref(false)

const user = computed(() => auth.user)

const initials = computed(() => {
  if (!user.value?.name) return ''
  return user.value.name
    .split(' ')
    .map(n => n[0])
    .join('')
})

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}

const editProfile = () => {
  dropdownOpen.value = false
  router.push('/profile')
}

const logout = async () => {
  dropdownOpen.value = false
  await auth.logout()
  router.push('/auth/login')
}
</script>
