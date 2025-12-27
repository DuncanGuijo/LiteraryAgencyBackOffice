import type { BookDTO } from '@/domains/books/dtos/BookDTO'
import { http } from '@/api/http'

export interface PaginatedBooks {
  data: BookDTO[]
  meta: {
    current_page: number
    per_page: number
    total: number
    last_page: number
  }
}

export class BookService {
  static async getBooks(page = 1, perPage = 5): Promise<PaginatedBooks> {
    return http.get<PaginatedBooks>('/books', {
      params: { page: page, perpage: perPage },
    } as any)
  }

  static async getBook(id: number): Promise<BookDTO> {
    return http.get<BookDTO>(`/books/${id}`)
  }

  static async createBook(payload: Partial<BookDTO>): Promise<BookDTO> {
    return http.post<BookDTO>('/books', payload)
  }

  static async updateBook(id: number, payload: Partial<BookDTO>): Promise<BookDTO> {
    return http.put<BookDTO>(`/books/${id}`, payload)
  }

  static async deleteBook(id: number): Promise<void> {
    return http.delete(`/books/${id}`)
  }
}
