<?php
/**
 * Creator service.
 */

namespace App\Service;

use App\Entity\Creator;
use App\Interface\CreatorServiceInterface;
use App\Repository\CreatorRepository;
use App\Repository\BookRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class CreatorService.
 */
class CreatorService implements CreatorServiceInterface
{
    /**
     * Creator repository.
     */
    private CreatorRepository $creatorRepository;

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
     * @param CreatorRepository     $creatorRepository Creator repository
     * @param BookRepository     $bookRepository Book repository
     * @param PaginatorInterface $paginator      Paginator
     */
    public function __construct(CreatorRepository $creatorRepository, BookRepository $bookRepository, PaginatorInterface $paginator)
    {
        $this->creatorRepository = $creatorRepository;
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
            $this->creatorRepository->queryAll(),
            $page,
            CreatorRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
    /**
     * Save entity.
     *
     * @param Creator $creator Creator entity
     */
    public function save(Creator $creator): void
    {
        $this->creatorRepository->save($creator);
    }
    public function delete(Creator $creator): void
    {
        $this->creatorRepository->delete($creator);
    }
    /**
     * Can Category be deleted?
     *
     * @param Creator $creator Creator entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Creator $creator): bool
    {
        try {
            $result = $this->bookRepository->countByCreator($creator);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }
}
