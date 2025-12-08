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
}