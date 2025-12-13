<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\AgencyDetailDTO;
use App\DTOS\AgencyDTO;
use App\Models\Agency;
use App\Repositories\AgencyRepositoryInterface;

final Class AgencyRepositoryEloquent implements AgencyRepositoryInterface {

    /**
     * Summary of create
     * @param AgencyDTO $AgencyDTO
     * @return AgencyDTO
     */
    public function create(AgencyDTO $AgencyDTO): AgencyDTO {
        $AgencyData = $AgencyDTO->toArray();
        $Agency = Agency::create($AgencyData);

        return AgencyDTO::fromModel($Agency);
    }

    /**
     * Summary of find
     * @param int $id
     * @return AgencyDTO
     */
    public function find(int $id): AgencyDTO {
        $Agency = Agency::find($id);
        
        return AgencyDTO::fromModel($Agency);
    }
    
    /**
     * @param AgencyDTO $dto
     * @return Agency
     *
     */
    public function update(AgencyDTO $dto): AgencyDTO
    {
        $agency = Agency::find($dto->id);

        $agencyData = [
            'name' => $dto->name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'address' => $dto->address,
            'is_active' => (int) $dto->is_active
        ];

        $agency->update($agencyData);

        $agency->refresh();

        $AgencyDTO = AgencyDTO::fromModel($agency);
        
        return $AgencyDTO;
    }

    /**
     * Summary of delete
     * @param int $id
     * @return void
     */
    public function delete(int $id): void {
        $Agency = Agency::find($id);
        $Agency->delete();
    }

    public function getPaginated(int $page = 1, int $perPage = 15): array
    {
        $paginator = Agency::query()
            ->with(['books', 'contracts'])
            ->paginate($perPage, ['*'], 'page', $page);

        $data = $paginator->getCollection()
            ->map(fn($agency) => AgencyDTO::fromModel($agency))
            ->all();

        return [
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ];
    }

    /**
     * Get Agency with their relations (author, agencies and genres)
     * @param int $id
     * @param array $relations
     * @return AgencyDetailDTO
     */
    
    public function findWithRelations(int $id, array $relations = []): AgencyDetailDTO {
                
        $AgencyDetail = Agency::with($relations)->find($id);
        
        return AgencyDetailDTO::fromModel($AgencyDetail);
    }

}