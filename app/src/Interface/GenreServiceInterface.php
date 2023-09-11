<?php
/**
 * Genre Service Interface.
 */

namespace App\Interface;

use App\Entity\Genre;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface GenreServiceInterface.
 */
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

    /**
     * @param Genre $genre Genre entity
     *
     * @return void Result
     */
    public function delete(Genre $genre): void;

    /**
     * Can Genre be deleted?
     *
     * @param Genre $genre Genre entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Genre $genre): bool;
}
