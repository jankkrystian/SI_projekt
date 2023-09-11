<?php
/**
 * Publisher Service Interface.
 */

namespace App\Interface;

use App\Entity\Publisher;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface PublisherServiceInterface.
 */
interface PublisherServiceInterface
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
     * @param Publisher $publisher Publisher entity
     */
    public function save(Publisher $publisher): void;

    /**
     * @param Publisher $publisher Publisher entity
     *
     * @return void Result
     */
    public function delete(Publisher $publisher): void;

    /**
     * Can Publisher be deleted?
     *
     * @param Publisher $publisher Publisher entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Publisher $publisher): bool;
}
