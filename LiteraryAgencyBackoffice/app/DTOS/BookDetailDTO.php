<?php 

declare(strict_types= 1);

namespace App\DTOS;

use App\Models\Book;
use Illuminate\Support\Carbon;
final readonly Class BookDetailDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $isbn,
        public readonly string $description,
        public readonly int $is_active,
        public readonly Carbon|null $publication_date,
        public ?AuthorDTO $author,
        public array $agencies,      // array<AgencyDTO>
        public array $genres         // array<GenreDTO>
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
            isset($author) ? $author : null,
            $data['agencies'],
            $data['genres']
        );
    }
    public function toArray() : array {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'isbn'         => $this->isbn,
            'description'  => $this->description,
            'is_active'    => $this->is_active,
            'publication_date' => $this->publication_date?->toDateString(),
            'author'       => $this->author,
            'agencies'     => $this->agencies,
            'genres'       => $this->genres 
        ];
    }

    public static function fromModel(Book $book): self
    {
        $authorDto = $book->relationLoaded('author') && $book->author
            ? AuthorDTO::fromModel($book->author)
            : null;

        $agenciesDto = $book->relationLoaded('agencies') && $book->agencies
            ? $book->agencies->map(fn($a) => AgencyDTO::fromModel($a))->all()
            : [];

        $genresDto = $book->relationLoaded('genres') && $book->genres
            ? $book->genres->map(fn($g) => GenreDTO::fromModel($g))->all()
            : [];

        return new self(
            $book->id ?? null,
            $book->title,
            $book->isbn,
            $book->description,
            (int) $book->is_active,
            $book->publication_date,
            $authorDto,
            $agenciesDto,
            $genresDto
        );
    }

}