<template>
  <AuthLayout>
    <!-- Header -->
    <div class="mb-10">
      <h2 class="text-2xl font-semibold text-gray-900">Create Account</h2>
      <p class="mt-2 text-sm text-gray-600">Register to access the agency management panel</p>
    </div>

    <!-- Form -->
    <form @submit.prevent="onSubmit" class="space-y-6">
      <!-- Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input
          v-model="form.name"
          type="text"
          :class="inputClass('name')"
        />
        <p v-if="errors.name" class="mt-1 text-sm text-red-500">{{ errors.name }}</p>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input
          v-model="form.email"
          type="email"
          :class="inputClass('email')"
        />
        <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input
          v-model="form.password"
          type="password"
          :class="inputClass('password')"
        />
        <p v-if="errors.password" class="mt-1 text-sm text-red-500">{{ errors.password }}</p>
      </div>

      <!-- Confirm Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input
          v-model="form.password_confirmation"
          type="password"
          :class="inputClass('password_confirmation')"
        />
        <p v-if="errors.password_confirmation" class="mt-1 text-sm text-red-500">{{ errors.password_confirmation }}</p>
      </div>

      <!-- Backend error general -->
      <p v-if="serverError" class="text-red-500 text-sm">{{ serverError }}</p>
      <!-- Success message -->
      <p v-if="successMessage" class="text-green-600 text-sm">{{ successMessage }}</p>

      <!-- Submit Button -->
      <button
        type="submit"
        :disabled="isSubmitDisabled"
        class="w-full rounded-md py-2.5 font-medium bg-slate-200 text-black hover:bg-slate-300 disabled:opacity-50 disabled:cursor-not-allowed transition"
      >
        <span v-if="loading">Creating...</span>
        <span v-else>Create Account</span>
      </button>
    </form>

    <div class="mt-8 text-sm text-gray-600">
      Already have an account?
      <router-link to="/login" class="ml-1 font-medium text-slate-800 hover:underline">Log in</router-link>
    </div>
  </AuthLayout>
</template>

<script setup lang="ts">
import { reactive, computed, ref } from 'vue'
import AuthLayout from '@/domains/layouts/AuthLayout.vue'
import { http } from '@/api/http'
import { useRouter } from 'vue-router'

interface FormRegister {
  name: string
  email: string
  password: string
  password_confirmation: string
}

const router = useRouter()
const form = reactive<FormRegister>({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const errors = reactive<Record<string, string>>({})
const serverError = ref('')
const successMessage = ref('')
const loading = ref(false)

function validateForm() {
  Object.keys(errors).forEach(key => delete errors[key])
  serverError.value = ''
  successMessage.value = ''

  if (!form.name.trim()) errors.name = 'Name is required'
  if (!form.email.trim()) errors.email = 'Email is required'
  else if (!/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(form.email)) errors.email = 'Invalid email'

  if (!form.password) errors.password = 'Password is required'
  if (form.password !== form.password_confirmation)
    errors.password_confirmation = 'Passwords do not match'

  return Object.keys(errors).length === 0
}

async function onSubmit(): Promise<void> {
  if (!validateForm()) return

  loading.value = true
  try {
    const payload = { ...form }
    await http.post('/v1/register', payload)
    successMessage.value = 'Registration successful! Redirecting to login...'
    setTimeout(() => {
    router.push({ path: '/login', query: { successMessage: 'Registration successful! Please log in.' } })
    }, 500)
  } catch (err: any) {
    if (err.response?.data?.errors) {
      Object.assign(errors, err.response.data.errors)
    } else if (err.response?.data?.message) {
      serverError.value = err.response.data.message
    } else {
      serverError.value = 'An unexpected error occurred'
    }
  } finally {
    loading.value = false
  }
}

const isSubmitDisabled = computed(() => Object.keys(errors).length > 0 || loading.value)

function inputClass(field: string) {
  return [
    'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-2',
    errors[field] ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-slate-700 focus:border-slate-700'
  ]
}
</script>
