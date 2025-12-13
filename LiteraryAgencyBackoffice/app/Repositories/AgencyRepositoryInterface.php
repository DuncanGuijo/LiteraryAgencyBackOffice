<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\AgencyDetailDTO;
use App\DTOS\AgencyDTO;
use App\Models\Agency;

interface AgencyRepositoryInterface {
    public function create(AgencyDTO $AgencyDTO): AgencyDTO;

    public function find(int $id): AgencyDTO;

    public function update(AgencyDTO $AgencyDTO): AgencyDTO;

    public function delete(int $id): void;

    public function getPaginated(int $page, int $perpage): array;

    public function findWithRelations(int $id, array $relations = []): AgencyDetailDTO;

}