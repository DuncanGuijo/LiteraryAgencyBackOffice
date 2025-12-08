<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOS\BookDTO;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\BookService;
use Illuminate\Support\Facades\Log;
final class BookController extends Controller
{

    public function __construct(
        protected BookService $BookService,
        protected BookRepositoryInterface $bookRepository
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
                'title' => 'required|string',
                'isbn' => 'nullable|string',
                'description' => 'nullable|string',
                'author_id' => 'nullable|int',
                'agencies_ids' => 'nullable|array',
                'genres' => 'nullable|array',
                'is_active' => 'int',
                'publication_date' => 'nullable|date_format:Y-m-d'
            ]);

            $data = $request->all();
            $bookDTO = BookDTO::fromArray($data);

            $book = $this->BookService->create($bookDTO);

            return response()->json($book, 201);

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
                'title' => 'required|string',
                'isbn' => 'nullable|string',
                'description' => 'nullable|string',
                'author_id' => 'nullable|int',
                'agencies_ids' => 'nullable|array',
                'genres' => 'nullable|array',
                'is_active' => 'int',
                'publication_date' => 'nullable|date_format:Y-m-d'
            ]);

            $data = $request->all();

            $bookDTO = BookDTO::fromArray($data);
            
            $book = $this->BookService->update($bookDTO);

            return response()->json($book, 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

   

}