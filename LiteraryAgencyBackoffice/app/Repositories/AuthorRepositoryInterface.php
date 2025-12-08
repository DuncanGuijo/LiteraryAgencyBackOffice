<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\AuthorDTO;
use App\Models\Author;

interface AuthorRepositoryInterface {
    public function create(AuthorDTO $AuthorDTO): AuthorDTO;

    public function find(int $id): AuthorDTO;

    public function update(AuthorDTO $AuthorDTO): AuthorDTO;

    public function delete(int $id): void;
}