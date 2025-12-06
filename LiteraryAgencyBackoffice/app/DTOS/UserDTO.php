<?php 

declare(strict_types= 1);

namespace App\DTOS;

use App\Models\User;
final readonly Class UserDTO {
    public function __construct(
        public readonly int|null $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string|null $password
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data["id"] ?? null,
            $data['name'],
            $data['email'],
            $data['password'] ?? null
        );
    }
    public function toArray() : array {
        return [
            "id" => $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            'password' => $this->password ? bcrypt($this->password) : null
        ];
    }

    public static function fromModel(User $user): self
    {
        return new self(
            $user->id ?? null,
            $user->name,
            $user->email,
            null
        );
    }

}