<?php 

declare(strict_types= 1);

namespace App\DTOS;

use App\Models\Agency;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

final readonly Class AuthorDetailDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone,
        public readonly int $is_active,
        public readonly array $books,      // array<BookDTO>
        public readonly array $contracts   // array<ContractDTO>
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['first_name'] ?? '',
            $data['last_name'] ?? '',
            $data['email'] ?? '',
            $data['phone'] ?? '',
            (int) $data['is_active'],
            $data['books'],
            $data['contracts']
        );
    }
    
    public function toArray() : array {
        return [
            'id'           => $this->id,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'is_active'    => $this->is_active,
            'books'        => $this->books,
            'contracts'    => $this->contracts
        ];
    }

    public static function fromModel(Author $author): self
    {
        $booksDetailsDto = $author->books
            ->map(fn (Book $book) => BookDTO::fromModel($book))
            ->all();
        
        $contractsDetailsDto = $author->contracts
            ->map(fn ($contract) => ContractDTO::fromModel($contract))
            ->all();

        return new self(
            $author->id ?? null,
            $author->first_name,
            $author->last_name,
            $author->email,
            $author->phone,
            (int) $author->is_active,
            $booksDetailsDto,
            $contractsDetailsDto
        );
    }

}