<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOS\GenreDTO;
use App\Repositories\GenreRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\GenreService;
use Illuminate\Support\Facades\Log;
final class GenreController extends Controller
{

    public function __construct(
        protected GenreService $GenreService,
        protected GenreRepositoryInterface $genreRepository
    ) {
    }

    /**
     * Summary of register
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'name' => 'required|string',
                'is_active' => 'int'
            ]);

            $data = $request->all();
            $genreDTO = GenreDTO::fromArray($data);

            $genre = $this->GenreService->create($genreDTO);

            return response()->json($genre, 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    /**
     * Summary of update
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'id' => 'required|int',
                'name' => 'required|string',
                'is_active' => 'int'
            ]);

            $data = $request->all();

            $genreDTO = GenreDTO::fromArray($data);
            
            $genre = $this->GenreService->update($genreDTO);

            return response()->json($genre, 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    /**
     * Summary of destroy
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            
            $request->validate([
                'id'=> 'required|int'
            ]);

            $this->GenreService->destroy($request->id);

            return response()->json('Succesfuly', 200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

}