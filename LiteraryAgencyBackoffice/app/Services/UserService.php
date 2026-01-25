<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOS\UserDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

final class UserService
{

    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * Summary of create
     * @param UserDTO $DTO
     * @return UserDTO
     */
    public function create(UserDTO $DTO): UserDTO
    {
        return $this->userRepository->create($DTO);
    }

    /**
     * Summary of update
     * @param UserDTO $DTO
     * @return UserDTO
     */
    public function update(int $id, UserDTO $DTO): UserDTO
    {
        return $this->userRepository->update($id, $DTO);
    }

    /**
     * Summary of login
     * @param object $request
     * @param User $userModel
     * @throws \Exception
     * @return array{token: string, user: UserDTO}
     */
    public function login(object $request, User $userModel): array
    {

        if (!$userModel || !\Hash::check($request->password, $userModel->password)) {
            throw new \Exception('Invalid credentials', 401);
        }

        $token = $userModel->createToken('api-token')->accessToken;

        $DTO = new UserDTO(
            $userModel->id,
            $userModel->name,
            $userModel->email,
            null
        );

        return [
            'user' => $DTO,
            'token' => $token,
        ];
    }
}