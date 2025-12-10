<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOS\BookDetailDTO;
use App\DTOS\BookDTO;
use App\Repositories\BookRepositoryInterface;
use DB;
use Illuminate\Support\Facades\Log;

final class BookService
{

    public function __construct(private BookRepositoryInterface $BookRepository)
    {
    }

    /**
     * Summary of create
     * @param BookDTO $DTO
     * @return BookDTO
     */
    public function create(BookDTO $DTO): BookDTO
    {
        return DB::transaction(function () use ($DTO) {
            return $this->BookRepository->create($DTO);
        });

    }

    /**
     * Summary of update
     * @param BookDTO $DTO
     * @return BookDTO
     */
    public function update(BookDTO $DTO): BookDTO
    {   
        return DB::transaction(function () use ($DTO) {
            return $this->BookRepository->update($DTO);
    
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
            $this->BookRepository->delete($id);
        });
    }

    /**
     * Summary of getBookDetail
     * @param int $id
     * @return BookDetailDTO
     */
    public function getBookDetail(int $id): BookDetailDTO
    {
        $book = $this->BookRepository->findWithRelations($id, ['author', 'agencies', 'genres']);

        return $book;
    }

    public function getPaginated(?int $page = 1, int $perPage = 15): array
    {
        $books = $this->BookRepository->getPaginated($page, $perPage);

        return $books;
    }
}