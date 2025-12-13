<?php 

declare(strict_types= 1);

namespace App\DTOS;

use App\Models\Agency;
use App\Models\AgencyBook;
use App\Models\Author;
use App\Models\Book;

final readonly Class AgencyDetailDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $address,
        public readonly int $is_active,
        public readonly array $books,      // array<BookDetailDTO>
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['phone'] ?? '',
            $data['address'] ?? '',
            (int) $data['is_active'],
            $data['books']
        );
    }

    public function toArray() : array {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'address'      => $this->address,
            'is_active'    => $this->is_active,
            'books'        => $this->books,
        ];
    }

    public static function fromModel(Agency $agency): self
    {
        $booksDetailsDto = $agency->books
            ->map(fn (Book $book) => BookDetailDTO::fromModel($book))
            ->all();

        return new self(
            $agency->id ?? null,
            $agency->name,
            $agency->email,
            $agency->phone,
            $agency->address,
            (int) $agency->is_active,
            $booksDetailsDto
        );
    }
}