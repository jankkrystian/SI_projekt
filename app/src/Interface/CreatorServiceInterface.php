<?php
/**
 * Creator Service Interface.
 */

namespace App\Interface;

use App\Entity\Creator;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface CreatorServiceInterface.
 */
interface CreatorServiceInterface
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
     * @param Creator $creator Creator entity
     */
    public function save(Creator $creator): void;

    /**
     * @param Creator $creator Creator entity
     *
     * @return void Result
     */
    public function delete(Creator $creator): void;

    /**
     * Can Category be deleted?
     *
     * @param Creator $creator Creator entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Creator $creator): bool;
}
