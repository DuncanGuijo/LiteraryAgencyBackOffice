<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOS\BookDTO;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\BookService;

final class BookController extends Controller
{

    public function __construct(
        protected BookService $BookService,
        protected BookRepositoryInterface $bookRepository
    ) {
    }

    /**
     * Create a book
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
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
    }

    /**
     * Update a book
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
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
    }

    /**
     * Soft delete of a book
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int'
        ]);
        
        $this->BookService->destroy($request->id);
        
        return response()->json('Succesfuly', 200);
    }

    /**
     * Show a book with their relatiosn
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $book = $this->BookService->getBookDetail($id);

        return response()->json($book, 200);
    }

    /**
     *  Get all the books with their relations paginated
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {  

        $request->validate([
            'pag' => 'nullable|int|min:1',
            'perpage' => 'nullable|int|min:1'
        ]);

        $books = $this->BookService->getPaginated((int) $request->pag ?? 1, (int) $request->perpage ?? 15);

        return response()->json($books, 200);
    }

}