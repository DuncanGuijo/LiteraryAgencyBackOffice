export interface BookDTO {
  id: number | null;
  title: string;
  isbn: string;
  description: string;
  author_id: number;
  agencies_ids: number[];
  genres: string[];
  is_active: number;
  publication_date: string | null;
}