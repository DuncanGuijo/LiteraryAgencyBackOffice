<template>
  <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>

    <form @submit.prevent="onSubmit" class="space-y-6">
      <!-- Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input
          v-model="form.name"
          type="text"
          :class="inputClass('name')"
          placeholder="Your name"
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
          placeholder="your@email.com"
        />
        <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank to keep current)</label>
        <input
          v-model="form.password"
          type="password"
          :class="inputClass('password')"
          placeholder="New password"
        />
        <p v-if="errors.password" class="mt-1 text-sm text-red-500">{{ errors.password }}</p>
      </div>

      <!-- Buttons -->
      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
          :disabled="loading"
        >
          <span v-if="loading">Saving...</span>
          <span v-else>Save Changes</span>
        </button>

        <button
          type="button"
          class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition"
          @click="cancel"
        >
          Cancel
        </button>
      </div>

      <!-- Messages -->
      <p v-if="serverError" class="text-red-500 text-sm mt-2">{{ serverError }}</p>
      <p v-if="successMessage" class="text-green-600 text-sm mt-2">{{ successMessage }}</p>
    </form>
  </div>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth.store';
import { UserService } from '@/domains/users/services/UserService';

const router = useRouter();
const auth = useAuthStore();

// Inicializamos form con los datos actuales del usuario
const form = reactive({
  name: auth.user?.name || '',
  email: auth.user?.email || '',
  password: '',   // opcional, solo se envía si el usuario quiere cambiar
});

const errors = reactive<Record<string, string>>({});
const serverError = ref('');
const successMessage = ref('');
const loading = ref(false);

// Validación simple
function validateForm() {
  Object.keys(errors).forEach(key => delete errors[key]);
  serverError.value = '';
  successMessage.value = '';

  if (!form.name.trim()) errors.name = 'Name is required';
  if (!form.email.trim()) errors.email = 'Email is required';
  else if (!/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(form.email)) errors.email = 'Invalid email';

  return Object.keys(errors).length === 0;
}

function inputClass(field: string) {
  return [
    'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-2',
    errors[field] ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500 focus:border-indigo-500',
  ];
}

async function onSubmit() {
  
  if (!validateForm()) return;
  loading.value = true;

  try {
    const payload: Record<string, any> = {
      name: form.name,
      email: form.email,
    };

    if (form.password) payload.password = form.password;

    const updatedUser = await UserService.update(auth.user!.id, payload);
    auth.setUser(updatedUser);
    successMessage.value = 'Profile updated successfully!';
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

function cancel() {
  router.push('/');
}
</script>