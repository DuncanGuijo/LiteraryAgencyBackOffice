<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\UserDTO;

interface UserRepositoryInterface {
    public function create(UserDTO $userDTO): UserDTO;

    public function find(int $id): UserDTO;

    public function findByEmail(string $email): UserDTO;
}