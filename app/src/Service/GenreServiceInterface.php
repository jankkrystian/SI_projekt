<?php

namespace App\Service;

use App\Entity\Genre;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface GenreServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Genre $genre Genre entity
     */
    public function save(Genre $genre): void;
}