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
        try {

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

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    /**
     * Update an author
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {

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

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

   /**
    * Soft delete of an author
    * @param Request $request
    * @return JsonResponse
    */
   public function destroy(Request $request): JsonResponse
   {
        try {
            $request->validate([
                'id'=> 'required|int'
            ]);

            $this->AuthorService->destroy($request->id);
            
            return response()->json('Succesfuly', 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
   }


   /**
    *  Get all the authors with their relations paginated
    * @param Request $request
    * @return JsonResponse
    */
   public function index(Request $request): JsonResponse
    {
        try {
            
            $request->validate([
                'pag' => 'nullable|int|min:1',
                'perpage' => 'nullable|int|min:1'
            ]);

            $books = $this->AuthorService->getPaginated($request->pag ?? 1, $request->perpage ?? 15);

            return response()->json($books, 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

    public function show(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'id'=> 'required|int'
            ]);

            $author = $this->AuthorService->getAuthorDetail($request->id);

            return response()->json($author, 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

}