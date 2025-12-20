<template>
  <div class="login-container">
    <h1>Login</h1>
    <form @submit.prevent="submit">
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p v-if="error" class="error">{{ error }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { UserService } from '../services/UserService';

export default defineComponent({
  name: 'Login',
  setup() {
    const email = ref('');
    const password = ref('');
    const error = ref('');

    const submit = async () => {
      try {
        const response = await UserService.login({ email: email.value, password: password.value });
        localStorage.setItem('auth_token', response.token);
        error.value = '';
        window.location.href = '/books';
      } catch (err: any) {
        error.value = err.response?.data?.message || 'Login failed';
      }
    };

    return { email, password, error, submit };
  },
});
</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: 50px auto;
  display: flex;
  flex-direction: column;
}
input {
  margin-bottom: 10px;
  padding: 8px;
  font-size: 16px;
}
button {
  padding: 10px;
  font-size: 16px;
}
.error {
  color: red;
}
</style>
