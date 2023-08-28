<?php
/**
 * Publisher service.
 */

namespace App\Service;

use App\Entity\Publisher;
use App\Interface\PublisherServiceInterface;
use App\Repository\PublisherRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class PublisherService.
 */
class PublisherService implements PublisherServiceInterface
{
    /**
     * Publisher repository.
     */
    private PublisherRepository $publisherRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param PublisherRepository     $publisherRepository Publisher repository
     * @param PaginatorInterface $paginator      Paginator
     */
    public function __construct(PublisherRepository $publisherRepository, PaginatorInterface $paginator)
    {
        $this->publisherRepository = $publisherRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->publisherRepository->queryAll(),
            $page,
            PublisherRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
    /**
     * Save entity.
     *
     * @param Publisher $publisher Publisher entity
     */
    public function save(Publisher $publisher): void
    {
        $this->publisherRepository->save($publisher);
    }
    public function delete(Publisher $publisher): void
    {
        $this->publisherRepository->delete($publisher);
    }
}
