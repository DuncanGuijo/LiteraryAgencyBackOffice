<?php 

declare(strict_types= 1);

namespace App\Services;

use App\DTOS\UserDTO;
use App\Repositories\UserRepositoryInterface;

final class UserService {

    public function __construct(private UserRepositoryInterface $userRepository) {
    }
    
    public function create(UserDTO $DTO): UserDTO {
        
        return $this->userRepository->create($DTO);

    }

    public function login(object $request, UserDTO $DTO): array
    {

        if (!$DTO || !\Hash::check($request->password, $DTO->password)) {
            throw new \Exception('Invalid credentials', 401);
        }

        // TO DO CREATE SESSION TOKEN
        $token = $DTO->createToken('api-token')->accessToken;

        return [
            'user' => $DTO,
            'token' => $token,
        ];
    }
}