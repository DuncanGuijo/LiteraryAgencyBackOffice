<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\AuthorDTO;
use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;

final Class AuthorRepositoryEloquent implements AuthorRepositoryInterface {

    /**
     * Summary of create
     * @param AuthorDTO $AuthorDTO
     * @return AuthorDTO
     */
    public function create(AuthorDTO $AuthorDTO): AuthorDTO {
        $AuthorData = $AuthorDTO->toArray();
        $Author = Author::create($AuthorData);

        return AuthorDTO::fromModel($Author);
    }

    /**
     * Summary of find
     * @param int $id
     * @return AuthorDTO
     */
    public function find(int $id): AuthorDTO {
        $Author = Author::find($id);
        
        return AuthorDTO::fromModel($Author);
    }
    
    /**
     * @param AuthorDTO $dto
     * @return Author
     *
     */
    public function update(AuthorDTO $dto): AuthorDTO
    {
        $author = Author::find($dto->id);

        $authorData = [
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'is_active' => (int) $dto->is_active
        ];

        $author->update($authorData);

        $author->refresh();

        $AuthorDTO = AuthorDTO::fromModel($author);
        
        return $AuthorDTO;
    }
}