<?php

namespace App\Service;

use App\Entity\Publisher;
use Knp\Component\Pager\Pagination\PaginationInterface;

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
}