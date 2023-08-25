<?php
/**
 * Genre service.
 */

namespace App\Service;

use App\Entity\Genre;
use App\Repository\RecordRepository;
use App\Service\GenreServiceInterface;
use App\Repository\GenreRepository;
use App\Repository\BookRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


/**
 * Class GenreService.
 */
class GenreService implements GenreServiceInterface
{
    /**
     * Genre repository.
     */
    private GenreRepository $genreRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Book repository
     */
    private BookRepository $bookRepository;

    /**
     * Constructor.
     *
     * @param GenreRepository     $genreRepository Genre repository
     * @param BookRepository     $bookRepository Book repository
     * @param PaginatorInterface $paginator      Paginator
     */
    public function __construct(GenreRepository $genreRepository, BookRepository $bookRepository, PaginatorInterface $paginator)
    {
        $this->genreRepository = $genreRepository;
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
            $this->genreRepository->queryAll(),
            $page,
            GenreRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
    /**
     * Save entity.
     *
     * @param Genre $genre Genre entity
     */
    public function save(Genre $genre): void
    {
        $this->genreRepository->save($genre);
    }

    public function delete(Genre $genre): void
    {
        $this->genreRepository->delete($genre);
    }
    /**
     * Find by id.
     *
     * @param int $id Category id
     *
     * @return Genre|null Category entity
     *
     * @throws NonUniqueResultException
     */
    public function findOneById(int $id): ?Genre
    {
        return $this->genreRepository->findOneById($id);
    }

}
