<?php
/**
 * Publisher service.
 */

namespace App\Service;

use App\Entity\Publisher;
use App\Interface\PublisherServiceInterface;
use App\Repository\PublisherRepository;
use App\Repository\BookRepository;
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
     * Book repository.
     */
    private BookRepository $bookRepository;

    /**
     * Constructor.
     *
     * @param PublisherRepository $publisherRepository Publisher repository
     * @param BookRepository      $bookRepository      Book repository
     * @param PaginatorInterface  $paginator           Paginator
     */
    public function __construct(PublisherRepository $publisherRepository, BookRepository $bookRepository, PaginatorInterface $paginator)
    {
        $this->publisherRepository = $publisherRepository;
        $this->bookRepository = $bookRepository;
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

    /**
     * Delete entity.
     *
     * @param Publisher $publisher Publisher entity
     */
    public function delete(Publisher $publisher): void
    {
        $this->publisherRepository->delete($publisher);
    }

    /**
     * Can Category be deleted?
     *
     * @param Publisher $publisher Publisher entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Publisher $publisher): bool
    {
        try {
            $result = $this->bookRepository->countByPublisher($publisher);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

    // CategoryService.php
    /**
     * Find by id.
     *
     * @param int $id Publisher id
     *
     * @return Publisher|null Publisher entity
     *
     * @throws NonUniqueResultException
     */
    public function findOneById(int $id): ?Publisher
    {
        return $this->publisherRepository->findOneById($id);
    }
}
