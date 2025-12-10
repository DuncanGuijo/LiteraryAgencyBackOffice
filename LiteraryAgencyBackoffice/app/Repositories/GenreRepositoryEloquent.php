<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\GenreDTO;
use App\Models\Genre;
use App\Repositories\GenreRepositoryInterface;

final Class GenreRepositoryEloquent implements GenreRepositoryInterface {

    /**
     * Summary of create
     * @param GenreDTO $GenreDTO
     * @return GenreDTO
     */
    public function create(GenreDTO $GenreDTO): GenreDTO {
        $GenreData = $GenreDTO->toArray();
        $Genre = Genre::create($GenreData);

        return GenreDTO::fromModel($Genre);
    }

    /**
     * Summary of find
     * @param int $id
     * @return GenreDTO
     */
    public function find(int $id): GenreDTO {
        $Genre = Genre::find($id);
        
        return GenreDTO::fromModel($Genre);
    }
    
    /**
     * @param GenreDTO $dto
     * @return Genre
     *
     */
    public function update(GenreDTO $dto): GenreDTO
    {
        $genre = Genre::find($dto->id);

        $genreData = [
            'name' => $dto->name,
            'is_active' => (int) $dto->is_active
        ];

        $genre->update($genreData);

        $genre->refresh();

        $GenreDTO = GenreDTO::fromModel($genre);
        
        return $GenreDTO;
    }

    /**
     * Summary of delete
     * @param int $id
     * @return void
     */
    public function delete(int $id): void {
        $Genre = Genre::find($id);
        $Genre->delete();
    }

    public function getPaginated(int $page = 1, int $perPage = 15): array
    {
        $paginator = Genre::query()
            ->paginate($perPage, ['*'], 'page', $page);

        $data = $paginator->getCollection()
            ->map(fn($genre) => GenreDTO::fromModel($genre))
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
}