<?php

declare(strict_types=1);

namespace App\DTOS;

use App\Models\Author;
use Illuminate\Support\Carbon;
final readonly class AuthorDTO
{
    public function __construct(
        public readonly int|null $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone,
        public readonly int $is_active
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['first_name'] ?? null,
            $data['last_name'] ?? null,
            $data['email'] ?? '',
            $data['phone'] ?? null,
            $data['is_active'] ?? 1
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => $this->is_active
        ];
    }

    public static function fromModel(Author $author): self
    {
        return new self(
            $author->id ?? null,
            $author->first_name ?? null,
            $author->last_name ?? null,
            $author->email,
            $author->phone,
            (int) $author->is_active
        );
    }
}