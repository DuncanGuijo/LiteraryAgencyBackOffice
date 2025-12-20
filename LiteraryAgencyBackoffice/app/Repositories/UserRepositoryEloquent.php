<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\UserDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

final Class UserRepositoryEloquent implements UserRepositoryInterface {

    public function create(UserDTO $userDTO): UserDTO {
        $userData = $userDTO->toArray();
        $user = User::create($userData);

        return UserDTO::fromModel($user);
    }

    public function find(int $id): UserDTO {
        $user = User::findOrFail($id);
        
        return UserDTO::fromModel($user);
    }

    public function findModelByEmail(string $email): User {
        return User::where("email", $email)->first();
    }
}