import type { BookDTO } from '@/domains/books/dtos/BookDTO';

export const mapBook = (data: any): BookDTO => ({
  id: data.id ?? null,
  title: data.title,
  isbn: data.isbn,
  description: data.description,
  author_id: data.author_id,
  agencies_ids: data.agencies_ids || [],
  genres: data.genres || [],
  is_active: data.is_active,
  publication_date: data.publication_date ?? null,
});