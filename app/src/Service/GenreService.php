<?php
/**
 * Genre service.
 */

namespace App\Service;

use App\Entity\Genre;
use App\Interface\GenreServiceInterface;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\QueryBuilder;
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
     * Can Category be deleted?
     *
     * @param Category $category Category entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Genre $genre): bool
    {
        try {
            $result = $this->bookRepository->countByGenre($genre);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }
    // CategoryService.php
    /**
     * Find by id.
     *
     * @param int $id Genre id
     *
     * @return Genre|null Genre entity
     *
     * @throws NonUniqueResultException
     */
    public function findOneById(int $id): ?Genre
    {
        return $this->genreRepository->findOneById($id);
    }

}