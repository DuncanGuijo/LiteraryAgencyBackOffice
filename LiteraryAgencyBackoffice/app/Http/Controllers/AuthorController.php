<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOS\AuthorDTO;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\AuthorService;
use Illuminate\Support\Facades\Log;
final class AuthorController extends Controller
{

    public function __construct(
        protected AuthorService $AuthorService,
        protected AuthorRepositoryInterface $authorRepository
    ) {
    }

    /**
     * Create an author
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'int'
        ]);

        $data = $request->all();
        $authorDTO = AuthorDTO::fromArray($data);

        $author = $this->AuthorService->create($authorDTO);

        return response()->json($author, 201);
    }

    /**
     * Update an author
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'int'
        ]);

        $data = $request->all();

        $authorDTO = AuthorDTO::fromArray($data);
        
        $author = $this->AuthorService->update($authorDTO);

        return response()->json($author, 201);
    }

   /**
    * Soft delete of an author
    * @param Request $request
    * @return JsonResponse
    */
   public function destroy(Request $request): JsonResponse
   {
        $request->validate([
            'id'=> 'required|int'
        ]);

        $this->AuthorService->destroy($request->id);
        
        return response()->json('Succesfuly', 200);
   }

   /**
    *  Get all the authors with their relations paginated
    * @param Request $request
    * @return JsonResponse
    */
   public function index(Request $request): JsonResponse
    {
        $request->validate([
            'pag' => 'nullable|int|min:1',
            'perpage' => 'nullable|int|min:1'
        ]);

        $books = $this->AuthorService->getPaginated((int) $request->pag ?? 1, (int) $request->perpage ?? 15);

        return response()->json($books, 200);
    }

    /**
     * Get an author with their relations
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $author = $this->AuthorService->getAuthorDetail($id);

        return response()->json($author, 200);
    }

}