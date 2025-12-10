<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOS\GenreDTO;
use App\Repositories\GenreRepositoryInterface;
use DB;

final class GenreService
{

    public function __construct(private GenreRepositoryInterface $GenreRepository)
    {
    }

    /**
     * Summary of create
     * @param GenreDTO $DTO
     * @return GenreDTO
     */
    public function create(GenreDTO $DTO): GenreDTO
    {
        return DB::transaction(function () use ($DTO) {
            return $this->GenreRepository->create($DTO);
        });

    }

    /**
     * Summary of update
     * @param GenreDTO $DTO
     * @return GenreDTO
     */
    public function update(GenreDTO $DTO): GenreDTO
    {   
        return DB::transaction(function () use ($DTO) {
            return $this->GenreRepository->update($DTO);
    
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
            $this->GenreRepository->delete($id);
        });
    }

    public function getPaginated(?int $page = 1, int $perPage = 15): array
    {
        $books = $this->GenreRepository->getPaginated($page, $perPage);

        return $books;
    }
}