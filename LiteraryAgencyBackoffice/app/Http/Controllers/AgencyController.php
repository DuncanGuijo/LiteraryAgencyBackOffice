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
     * Summary of register
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {

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
                'email' => 'nullable|string',
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
                'is_active' => 'int'
            ]);

            $data = $request->all();

            $agencyDTO = AgencyDTO::fromArray($data);
            
            $agency = $this->AgencyService->update($agencyDTO);

            return response()->json($agency, 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

   

}