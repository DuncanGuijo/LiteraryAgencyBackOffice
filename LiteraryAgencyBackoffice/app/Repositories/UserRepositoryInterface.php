<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\UserDTO;
use App\Models\User;

interface UserRepositoryInterface {
    public function create(UserDTO $userDTO): UserDTO;

    public function find(int $id): UserDTO;

    public function findByEmail(string $email): UserDTO;
    
    public function findModelByEmail(string $email): User;
    
    public function findModelById(string $email): User;
}