<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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

    public function register(Request $request): JsonResponse 
    {
        try {

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $DTO = new UserDTO(null, $request->name, $request->email, $request->password);

            $user = $this->userService->create($DTO);

            return response()->json($user, 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
        
    }

    public function login(Request $request): JsonResponse 
    {
        try {
            
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            
            $userModel = $this->userRepository->findModelByEmail($request->email);
        
            $data = $this->userService->login($request, $userModel);

            return response()->json($data);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

}