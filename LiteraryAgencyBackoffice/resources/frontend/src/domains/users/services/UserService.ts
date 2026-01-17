import { http } from '@/api/http';
import type { LoginDTO } from '@/domains/users/dtos/LoginDTO';
import type { LoginResponseDTO } from '@/domains/users/dtos/LoginResponseDTO';

export class UserService {
  static async login(payload: LoginDTO): Promise<LoginResponseDTO> {
    return http.post<LoginResponseDTO>('/login', payload);
  }
}
