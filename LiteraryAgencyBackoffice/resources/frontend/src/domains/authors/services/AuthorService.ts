import { http } from '@/api/http'
import type { AuthorDTO } from '@/domains/authors/dtos/AuthorDTO'

export interface PaginatedAuthors {
  data: AuthorDTO[]
  meta: {
    current_page: number
    per_page: number
    total: number
    last_page: number
  }
}

export class AuthorService {
  static async getAuthors(page = 1, perPage = 5): Promise<PaginatedAuthors> {
    return http.get<PaginatedAuthors>('/authors', {
      params: { page: page, perpage: perPage },
    } as any)
  }

  static async getAuthor(id: number): Promise<AuthorDTO> {
    return http.get<AuthorDTO>(`/authors/${id}`)
  }

  static async createAuthor(payload: Partial<AuthorDTO>): Promise<AuthorDTO> {
    return http.post<AuthorDTO>('/authors', payload)
  }

  static async updateAuthor(id: number, payload: Partial<AuthorDTO>): Promise<AuthorDTO> {
    return http.put<AuthorDTO>(`/authors/${id}`, payload)
  }

  static async deleteAuthor(id: number): Promise<void> {
    return http.delete(`/authors/${id}`)
  }
}
