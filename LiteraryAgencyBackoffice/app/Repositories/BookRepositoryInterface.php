<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\BookDetailDTO;
use App\DTOS\BookDTO;
use App\Models\Book;

interface BookRepositoryInterface {
    public function create(BookDTO $BookDTO): BookDTO;

    public function find(int $id): BookDTO;

    public function findWithRelations(int $id, array $relations = []): BookDetailDTO;

    public function update(BookDTO $BookDTO): BookDTO;

    public function delete(int $id): void;

    public function getPaginated(int $page, int $perpage): array;
}