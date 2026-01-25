import type { UserDTO } from "@/domains/users/dtos/UserDTO";
import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as UserDTO | null,
    token: localStorage.getItem('auth_token') || '',
  }),

  getters: {
    isLoggedIn: (state) => !!state.token && !!state.user,
  },

  actions: {
    setToken(token: string) {
      this.token = token;
      localStorage.setItem('auth_token', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },

    setUser(user: UserDTO) {
      this.user = user;
    },

    async logout() {
      try {
        if (this.token) await axios.post('/logout');
      } finally {
        this.token = '';
        this.user = null;
        localStorage.removeItem('auth_token');
        delete axios.defaults.headers.common['Authorization'];
      }
    }
  }
});
