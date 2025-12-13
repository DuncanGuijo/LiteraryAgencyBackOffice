<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\AuthorDetailDTO;
use App\DTOS\AuthorDTO;

interface AuthorRepositoryInterface {
    public function create(AuthorDTO $AuthorDTO): AuthorDTO;

    public function find(int $id): AuthorDTO;

    public function update(AuthorDTO $AuthorDTO): AuthorDTO;

    public function delete(int $id): void;

    public function getPaginated(int $page, int $perpage): array;

    public function findWithRelations(int $id, array $relations = []): AuthorDetailDTO;

}