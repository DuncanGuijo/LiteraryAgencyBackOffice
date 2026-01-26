import { defineStore } from 'pinia';
import { UserService } from '@/domains/users/services/UserService';
import type { UserDTO } from '@/domains/users/dtos/UserDTO';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as UserDTO | null,
    token: localStorage.getItem('auth_token') || '',
  }),

  getters: {
    isLoggedIn: (state) => !!state.token && !!state.user,
  },

  actions: {
    setAuth(token: string, user: UserDTO) {
      this.token = token;
      this.user = user;
      localStorage.setItem('auth_token', token);
    },

    async logout() {
      try {
        if (this.token) {
          await UserService.logout();
        }
      } catch (e) {
        console.warn('Logout failed, clearing local session anyway');
      } finally {
        this.token = '';
        this.user = null;
        localStorage.removeItem('auth_token');
      }
    },
  },
});
