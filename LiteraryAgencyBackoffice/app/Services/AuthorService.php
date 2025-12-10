<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOS\AuthorDTO;
use App\Repositories\AuthorRepositoryInterface;
use DB;

final class AuthorService
{

    public function __construct(private AuthorRepositoryInterface $AuthorRepository)
    {
    }

    /**
     * Summary of create
     * @param AuthorDTO $DTO
     * @return AuthorDTO
     */
    public function create(AuthorDTO $DTO): AuthorDTO
    {
        return DB::transaction(function () use ($DTO) {
            return $this->AuthorRepository->create($DTO);
        });

    }

    /**
     * Summary of update
     * @param AuthorDTO $DTO
     * @return AuthorDTO
     */
    public function update(AuthorDTO $DTO): AuthorDTO
    {   
        return DB::transaction(function () use ($DTO) {
            return $this->AuthorRepository->update($DTO);
    
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
            $this->AuthorRepository->delete($id);
        });
    }

    public function getPaginated(?int $page = 1, int $perPage = 15): array
    {
        $books = $this->AuthorRepository->getPaginated($page, $perPage);

        return $books;
    }
}