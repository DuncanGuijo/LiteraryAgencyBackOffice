<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\DTOS\BookDTO;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;

final Class BookRepositoryEloquent implements BookRepositoryInterface {

    /**
     * Summary of create
     * @param BookDTO $BookDTO
     * @return BookDTO
     */
    public function create(BookDTO $BookDTO): BookDTO {
        $BookData = $BookDTO->toArray();
        $Book = Book::create($BookData);

        return BookDTO::fromModel($Book);
    }

    /**
     * Summary of find
     * @param int $id
     * @return BookDTO
     */
    public function find(int $id): BookDTO {
        $Book = Book::find($id);
        
        return BookDTO::fromModel($Book);
    }
    
    /**
     * @param BookDTO $dto
     * @return Book
     *
     */
    public function update(BookDTO $dto): BookDTO
    {
        $book = Book::find($dto->id);

        $bookData = [
            'title' => $dto->title,
            'isbn' => $dto->isbn,
            'description' => $dto->description,
            'author_id' => $dto->author_id,
            'is_active' => (int) $dto->is_active,
            'publication_date' => $dto->publication_date?->toDateString(),
            'agencies_id'   => $dto->agencies_ids,
            'genres' => $dto->genres,
        ];

        $book->update($bookData);

        // if (!empty($dto->agencies_ids)) {
        //     $ids = array_map('intval', $dto->agencies_ids);
        //     $book->agencies()->sync($ids);
        // }

        $book->refresh();

        $BookDTO = BookDTO::fromModel($book);
        
        return $BookDTO;
    }
}