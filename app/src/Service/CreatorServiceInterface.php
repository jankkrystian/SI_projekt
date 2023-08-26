<?php

namespace App\Service;

use App\Entity\Creator;
use Knp\Component\Pager\Pagination\PaginationInterface;

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


}