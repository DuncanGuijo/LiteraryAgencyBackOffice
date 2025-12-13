<?php 

declare(strict_types= 1);

namespace App\DTOS;

use Illuminate\Support\Carbon;

final class ContractDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $document_path,
        public readonly int $book_id,
        public readonly int $author_id,
        public readonly int $agency_id,
        public readonly int $is_active,
        public readonly Carbon $created_at
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['document_path'] ?? '',
            $data['book_id'] ?? 0,
            $data['author_id'] ?? 0,
            $data['agency_id'] ?? 0,
            $data['is_active'] ?? 0,
            new Carbon($data['created_at']),
        );
    }
    
    public function toArray() : array {
        return [
            'id'                   => $this->id,
            'document_path'        => $this->document_path,
            'book_id'              => $this->book_id,
            'author_id'            => $this->author_id,
            'agency_id'            => $this->agency_id,
            'is_active'            => $this->is_active,
            'created_at'           => $this->created_at->toDateString(),
        ];
    }

    public static function fromModel($contract): self
    {
        return new self(
            $contract->id ?? null,
            $contract->document_path,
            $contract->book_id,
            $contract->author_id,
            $contract->agency_id,
            (int) $contract->is_active,
            new Carbon($contract->created_at),
        );
    }
}