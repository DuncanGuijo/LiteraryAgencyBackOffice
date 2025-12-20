import type { CreateBookDTO } from '@/domains/books/dtos/CreateBookDTO';

export interface UpdateBookDTO extends Partial<CreateBookDTO> {
  id: number;
}
