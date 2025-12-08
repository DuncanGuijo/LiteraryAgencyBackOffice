<?php 

declare(strict_types= 1);

namespace App\DTOS;

use App\Models\Book;
use Illuminate\Support\Carbon;
final readonly Class BookDTO {
    public function __construct(
        public readonly int|null $id,
        public readonly string $title,
        public readonly string $isbn,
        public readonly string $description,
        public readonly int $author_id,
        public readonly array $agencies_ids,
        public readonly array $genres,
        public readonly int $is_active,
        public readonly Carbon|null $publication_date,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? '',
            $data['isbn'] ?? null,
            $data['description'] ?? '',
            $data['author_id'] ?? null,
            $data['agencies_ids'] ?? [],
            $data['genres'] ?? [],
            $data['is_active'] ?? 1,
            isset($data['publication_date']) ? Carbon::parse($data['publication_date']) : null        );
    }
    public function toArray() : array {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'isbn'         => $this->isbn,
            'description'  => $this->description,
            'author_id'    => $this->author_id,
            'agencies_ids' => $this->agencies_ids,
            'genres'       => $this->genres,
            'is_active'    => $this->is_active,
            'publication_date' => $this->publication_date?->toDateString()
        ];
    }

    public static function fromModel(Book $book): self
    {
        return new self(
            $book->id ?? null,
            $book->title,
            $book->isbn,
            $book->description,
            $book->author_id ?? null,
            $book->agencies_ids ?? [],
            $book->genres ?? [],
            (int) $book->is_active,
            $book->publication_date,
        );
    }

}