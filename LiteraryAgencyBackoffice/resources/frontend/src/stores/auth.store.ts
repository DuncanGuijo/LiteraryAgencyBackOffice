import type { UserDTO } from "@/domains/users/dtos/UserDTO";
import { defineStore } from "pinia";

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as UserDTO | null,
  }),
})
