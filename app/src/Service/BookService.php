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
     * Genre service
     */
    private GenreServiceInterface $genreService;

    /**
     * Publisher service
     */
    private PublisherServiceInterface $publisherService;

    /**
     * Creator service
     */
    private CreatorServiceInterface $creatorService;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param BookRepository     $bookRepository Book repository
     * @param GenreServiceInterface $genreService Genre serive
     * @param PublisherServiceInterface $publisherService Publisher serive
     * @param CreatorServiceInterface $creatorService Creator serive
     * @param PaginatorInterface $paginator      Paginator
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
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->bookRepository->queryAll(),
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
    public function delete(Book $book): void
    {
        $this->bookRepository->delete($book);
    }
}
