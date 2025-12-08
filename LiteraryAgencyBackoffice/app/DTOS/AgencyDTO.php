<?php

declare(strict_types=1);

namespace App\DTOS;

use App\Models\Agency;
use Illuminate\Support\Carbon;
final readonly class AgencyDTO
{
    public function __construct(
        public readonly int|null $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $address,
        public readonly int $is_active
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['email'] ?? '',
            $data['phone'] ?? null,
            $data['address'] ?? '',
            $data['is_active'] ?? 1
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'is_active' => $this->is_active
        ];
    }

    public static function fromModel(Agency $agency): self
    {
        return new self(
            $agency->id ?? null,
            $agency->name ?? null,
            $agency->email,
            $agency->phone,
            $agency->address,
            (int) $agency->is_active
        );
    }

}