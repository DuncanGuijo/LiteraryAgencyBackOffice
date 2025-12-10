<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOS\AgencyDTO;
use App\Models\Agency;
use App\Repositories\AgencyRepositoryInterface;
use DB;

final class AgencyService
{

    public function __construct(private AgencyRepositoryInterface $AgencyRepository)
    {
    }

    /**
     * Summary of create
     * @param AgencyDTO $DTO
     * @return AgencyDTO
     */
    public function create(AgencyDTO $DTO): AgencyDTO
    {
        return DB::transaction(function () use ($DTO) {
            return $this->AgencyRepository->create($DTO);
        });

    }

    /**
     * Summary of update
     * @param AgencyDTO $DTO
     * @return AgencyDTO
     */
    public function update(AgencyDTO $DTO): AgencyDTO
    {   
        return DB::transaction(function () use ($DTO) {
            return $this->AgencyRepository->update($DTO);
    
        });
    }

    /**
     * Summary of delete
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->AgencyRepository->delete($id);
        });
    }

    public function getPaginated(?int $page = 1, int $perPage = 15): array
    {
        $books = $this->AgencyRepository->getPaginated($page, $perPage);

        return $books;
    }
}