<?php

declare(strict_types=1);

namespace App\DTOS;

use App\Models\Genre;
use Illuminate\Support\Carbon;
final readonly class GenreDTO
{
    public function __construct(
        public readonly int|null $id,
        public readonly string $name,
        public readonly int $is_active
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'],
            $data['is_active'] ?? 1
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_active' => $this->is_active
        ];
    }

    public static function fromModel(Genre $genre): self
    {
        return new self(
            $genre->id ?? null,
            $genre->name,
            (int) $genre->is_active
        );
    }

}