import { http } from '@/api/http';
import type { BookDTO } from '@/domains/books/dtos/BookDTO';
import type { CreateBookDTO } from '@/domains/books/dtos/CreateBookDTO';
import type { UpdateBookDTO } from '@/domains/books/dtos/UpdateBookDTO';
import { mapBook } from '@/domains/books/mappers/book.mapper';

export class BookService {
  static async list(): Promise<BookDTO[]> {
    const data = await http.get<BookDTO[]>('v1/books');
    return data.map(mapBook);
  }

  static async get(id: number): Promise<BookDTO> {
    const data = await http.get<BookDTO>(`/books/${id}`);
    return mapBook(data);
  }

  static async create(payload: CreateBookDTO): Promise<BookDTO> {
    const data = await http.post<BookDTO>('/books', payload);
    return mapBook(data);
  }

  static async update(id: number, payload: UpdateBookDTO): Promise<BookDTO> {
    const data = await http.put<BookDTO>(`/books/${id}`, payload);
    return mapBook(data);
  }

  static async delete(id: number): Promise<void> {
    await http.delete(`/books/${id}`);
  }
}
