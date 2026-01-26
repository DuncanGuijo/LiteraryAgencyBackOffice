import { http } from '@/api/http';
import type { LoginDTO } from '@/domains/users/dtos/LoginDTO';
import type { LoginResponseDTO } from '@/domains/users/dtos/LoginResponseDTO';

export class UserService {
  static async login(payload: LoginDTO): Promise<LoginResponseDTO> {
    const response = await http.post<LoginResponseDTO>('/login', payload);
    return response;
  }
  static async update(id: number, payload: any): Promise<any> {
    return http.put(`/user/${id}`, payload);
  }
  static async logout(): Promise<void> {
    return http.post('/logout');
  }

}
