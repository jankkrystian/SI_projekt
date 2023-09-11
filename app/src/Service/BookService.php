<?php
/**
 * Book service.
 */

namespace App\Service;

use App\Entity\Book;
use App\Interface\BookServiceInterface;
use App\Interface\GenreServiceInterface;
use App\Interface\PublisherServiceInterface;
use App\Interface\CreatorServiceInterface;
use App\Repository\BookRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class BookService.
 */
class BookService implements BookServiceInterface
{
    /**
     * Book repository.
     */
    private BookRepository $bookRepository;

    /**
     * Genre service.
     */
    private GenreServiceInterface $genreService;

    /**
     * Publisher service.
     */
    private PublisherServiceInterface $publisherService;

    /**
     * Creator service.
     */
    private CreatorServiceInterface $creatorService;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param BookRepository            $bookRepository   Book repository
     * @param GenreServiceInterface     $genreService     Genre serive
     * @param PublisherServiceInterface $publisherService Publisher serive
     * @param CreatorServiceInterface   $creatorService   Creator serive
     * @param PaginatorInterface        $paginator        Paginator
     */
    public function __construct(BookRepository $bookRepository, GenreServiceInterface $genreService, PublisherServiceInterface $publisherService, CreatorServiceInterface $creatorService, PaginatorInterface $paginator)
    {
        $this->bookRepository = $bookRepository;
        $this->genreService = $genreService;
        $this->publisherService = $publisherService;
        $this->creatorService = $creatorService;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int                $page    Page number
     * @param array<string, int> $filters Raw filters from request
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, array $filters = []): PaginationInterface
    {
        $filters = $this->prepareFilters($filters);

        return $this->paginator->paginate(
            $this->bookRepository->queryAll($filters),
            $page,
            BookRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Book $book Book entity
     */
    public function save(Book $book): void
    {
        $this->bookRepository->save($book);
    }

    /**
     * Delete entity.
     *
     * @param Book $book Book entity
     */
    public function delete(Book $book): void
    {
        $this->bookRepository->delete($book);
    }

    /**
     * Prepare filters for the tasks list.
     *
     * @param array<string, int> $filters Raw filters from request
     *
     * @return array<string, object> Result array of filters
     */
    private function prepareFilters(array $filters): array
    {
        $resultFilters = [];
        if (!empty($filters['genre_id'])) {
            $genre = $this->genreService->findOneById($filters['genre_id']);
            if (null !== $genre) {
                $resultFilters['genre'] = $genre;
            }
        }

        if (!empty($filters['publisher_id'])) {
            $publisher = $this->publisherService->findOneById($filters['publisher_id']);
            if (null !== $publisher) {
                $resultFilters['publisher'] = $publisher;
            }
        }

        if (!empty($filters['creator_id'])) {
            $creator = $this->creatorService->findOneById($filters['creator_id']);
            if (null !== $creator) {
                $resultFilters['creator'] = $creator;
            }
        }

        return $resultFilters;
    }
}
