<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\GenreDTO;
use App\Models\Genre;

interface GenreRepositoryInterface {
    public function create(GenreDTO $GenreDTO): GenreDTO;

    public function find(int $id): GenreDTO;

    public function update(GenreDTO $GenreDTO): GenreDTO;

    public function delete(int $id): void;
}