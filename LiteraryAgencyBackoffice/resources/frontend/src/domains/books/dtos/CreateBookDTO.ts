export interface CreateBookDTO {
  title: string;
  isbn: string;
  description: string;
  author_id: number;
  agencies_ids: number[];
  genres: string[];
  publication_date: string | null;
  is_active: number;
}