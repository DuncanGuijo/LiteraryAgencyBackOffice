import { http } from '@/api/http'
import type { GenreDTO } from '@/domains/genres/dtos/GenreDTO'

export interface PaginatedGenres {
  data: GenreDTO[]
  meta: {
    current_page: number
    per_page: number
    total: number
    last_page: number
  }
}

export class GenreService {
  static async getGenres(page = 1, perPage = 5): Promise<PaginatedGenres> {
    return http.get<PaginatedGenres>('/genres', {
      params: { page: page, perpage: perPage },
    } as any)
  }

  static async getGenre(id: number): Promise<GenreDTO> {
    return http.get<GenreDTO>(`/genres/${id}`)
  }

  static async createGenre(payload: Partial<GenreDTO>): Promise<GenreDTO> {
    return http.post<GenreDTO>('/genres', payload)
  }

  static async updateGenre(id: number, payload: Partial<GenreDTO>): Promise<GenreDTO> {
    return http.put<GenreDTO>(`/genres/${id}`, payload)
  }

  static async deleteGenre(id: number): Promise<void> {
    return http.delete(`/genres/${id}`)
  }
}
