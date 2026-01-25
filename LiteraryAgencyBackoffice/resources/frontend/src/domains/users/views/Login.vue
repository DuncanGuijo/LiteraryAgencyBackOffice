<template>
    <div class="mb-10">
      <h2 class="text-2xl font-semibold text-gray-900">Log In</h2>
      <p class="mt-2 text-sm text-gray-600">Access the agency management panel</p>
    </div>

    <p v-if="successMessage" class="text-green-600 text-sm mb-4">{{ successMessage }}</p>

    <form @submit.prevent="onSubmit" class="space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input v-model="form.email" type="email" :class="inputClass('email')" />
        <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input v-model="form.password" type="password" :class="inputClass('password')" />
        <p v-if="errors.password" class="mt-1 text-sm text-red-500">{{ errors.password }}</p>
      </div>

      <p v-if="serverError" class="text-red-500 text-sm">{{ serverError }}</p>

      <button
        type="submit"
        class="w-full rounded-md py-2.5 font-medium bg-slate-200 text-black hover:bg-slate-300 disabled:opacity-50 disabled:cursor-not-allowed transition"
      >
        <span v-if="loading">Logging in...</span>
        <span v-else>Log In</span>
      </button>
    </form>

    <div class="mt-8 text-sm text-gray-600">
      Don't have an account?
      <router-link to="/auth/register" class="ml-1 font-medium text-slate-800 hover:underline">Sign up</router-link>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import { reactive, computed, ref } from 'vue'
import { UserService } from '@/domains/users/services/UserService'
import type { LoginDTO } from '@/domains/users/dtos/LoginDTO'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth.store';
import { UserDTO } from '../dtos/UserDTO'

const auth = useAuthStore();
const route = useRoute()
const successMessage = ref<string | null>(route.query.successMessage as string || null)
const router = useRouter()
const form = reactive<LoginDTO>({
  email: '',
  password: ''
})

const errors = reactive<Record<string, string>>({})
const serverError = ref('')
const loading = ref(false)

function validateForm() {
  Object.keys(errors).forEach(key => delete errors[key])
  serverError.value = ''

  if (!form.email.trim()) errors.email = 'Email is required'
  else if (!/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(form.email)) errors.email = 'Invalid email'

  if (!form.password) errors.password = 'Password is required'

  return Object.keys(errors).length === 0
}

async function onSubmit(): Promise<void> {
  if (!validateForm()) return;

  loading.value = true;
  try {
      const response = await UserService.login({ ...form });
      const user = new UserDTO(
      response.user.id,
      response.user.name,
      response.user.email,
      // response.user.avatarFile ?? null
    )
    auth.setAuth(response.token, user)

    router.push('/');
  } catch (err: any) {
    if (err.response?.data?.errors) {
      Object.assign(errors, err.response.data.errors);
    } else if (err.response?.data?.message) {
      serverError.value = err.response.data.message;
    } else {
      serverError.value = 'An unexpected error occurred';
    }
  } finally {
    loading.value = false;
  }
}


function inputClass(field: string) {
  return [
    'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-2',
    errors[field] ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-slate-700 focus:border-slate-700'
  ]
}
</script>
