<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\DTOS\UserDTO;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
final class UserController extends Controller{

    public function __construct( 
        protected UserService $userService,
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * Register a user
     * @param Request $request
     * @return JsonResponse
     */
    public function register(SignUpRequest $request): JsonResponse 
    {
        $DTO = new UserDTO(null, $request->name, $request->email, $request->password);

        $user = $this->userService->create($DTO);

        return response()->json($user, 201);
        
    }

    /**
     * Login
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse 
    {

        $userModel = $this->userRepository->findModelByEmail($request->email);
    
        $data = $this->userService->login($request, $userModel);

        return response()->json($data);
    }

    /**
     * Logout of the session
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse 
    {
        $token = $request->user()->token();

        $token->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get a user
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function get(Request $request, int $id): JsonResponse
    {
        $user = $this->userRepository->find( (int)$id);

        return response()->json($user);
    }


    /**
     * Summary of update
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id): JsonResponse
    {
        // TO DO
    }
}