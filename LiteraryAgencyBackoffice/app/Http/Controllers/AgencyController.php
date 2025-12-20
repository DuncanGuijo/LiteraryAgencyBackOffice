<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOS\AgencyDTO;
use App\Repositories\AgencyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\AgencyService;
use Illuminate\Support\Facades\Log;
final class AgencyController extends Controller
{

    public function __construct(
        protected AgencyService $AgencyService,
        protected AgencyRepositoryInterface $agencyRepository
    ) {
    }

    /**
     * Create an agency
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'is_active' => 'int'
        ]);

        $data = $request->all();
        $agencyDTO = AgencyDTO::fromArray($data);

        $agency = $this->AgencyService->create($agencyDTO);

        return response()->json($agency, 201);
    }

    /**
     * Update an agency
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int',
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'is_active' => 'int'
        ]);

        $data = $request->all();

        $agencyDTO = AgencyDTO::fromArray($data);
        
        $agency = $this->AgencyService->update($agencyDTO);

        return response()->json($agency, 201);
    }

    /**
     * Soft delete of an agency
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'id'=> 'required|int'
        ]);

        $this->AgencyService->destroy($request->id);

        return response()->json('Succesfuly', 200);
    }

    /**
     *  Get all the agencies with their relations paginated
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'pag' => 'nullable|int|min:1',
            'perpage' => 'nullable|int|min:1'
        ]);

        $books = $this->AgencyService->getPaginated($request->pag ?? 1, $request->perpage ?? 15);

        return response()->json($books, 200);
    }

    /**
     * Get an agency with all their relations
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $agency = $this->AgencyService->getAgencyDetail($id);

        return response()->json($agency, 200);
    }
}