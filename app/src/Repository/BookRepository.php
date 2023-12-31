<?php
/**
 * Book repository.
 */

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Creator;
use App\Entity\Publisher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @psalm-suppress LessSpecificImplementedReturnType
 */
class BookRepository extends ServiceEntityRepository
{
    /**
     * Items per page.
     *
     * Use constants to define configuration options that rarely change instead
     * of specifying them in configuration files.
     * See https://symfony.com/doc/current/best_practices.html#configuration
     *
     * @constant int
     */
    public const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Manager registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Query all records.
     *
     * @param array $filters Filter array
     *
     * @return QueryBuilder Query builder
     */
    public function queryAll(array $filters): QueryBuilder
    {
        $queryBuilder =  $this->getOrCreateQueryBuilder()
            ->select(
                'partial book.{id, title, availability}',
                'partial genre.{id, genreTitle}',
                'partial publisher.{id, publisherTitle}',
                'partial creator.{id, nick, name, surname}',
            )
            ->join('book.genre', 'genre')
            ->join('book.publisher', 'publisher')
            ->join('book.creator', 'creator')
            ->orderBy('book.title', 'DESC');

        return $this->applyFiltersToList($queryBuilder, $filters);
    }

    // ...
    /**
     * Save entity.
     *
     * @param Book $book Book entity
     */
    public function save(Book $book): void
    {
        $this->_em->persist($book);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Book $book Book entity
     */
    public function delete(Book $book): void
    {
        $this->_em->remove($book);
        $this->_em->flush();
    }

    /**
     * Count books by category.
     *
     * @param Genre $genre Genre
     *
     * @return int Number of books in genre
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByGenre(Genre $genre): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('book.id'))
            ->where('book.genre = :genre')
            ->setParameter(':genre', $genre)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count books by publisher.
     *
     * @param Publisher $publisher Publisher
     *
     * @return int Number of books in publisher
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByPublisher(Publisher $publisher): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('book.id'))
            ->where('book.publisher = :publisher')
            ->setParameter(':publisher', $publisher)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count books by creator.
     *
     * @param Creator $creator Creator
     *
     * @return int Number of books in creator
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByCreator(Creator $creator): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('book.id'))
            ->where('book.creator = :creator')
            ->setParameter(':creator', $creator)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Apply filters to paginated list.
     *
     * @param QueryBuilder          $queryBuilder Query builder
     * @param array<string, object> $filters      Filters array
     *
     * @return QueryBuilder Query builder
     */
    private function applyFiltersToList(QueryBuilder $queryBuilder, array $filters = []): QueryBuilder
    {
        if (isset($filters['genre']) && $filters['genre'] instanceof Genre) {
            $queryBuilder->andWhere('genre = :genre')
                ->setParameter('genre', $filters['genre']);
        }

        if (isset($filters['publisher']) && $filters['publisher'] instanceof Publisher) {
            $queryBuilder->andWhere('publisher = :publisher')
                ->setParameter('publisher', $filters['publisher']);
        }

        if (isset($filters['creator']) && $filters['creator'] instanceof Creator) {
            $queryBuilder->andWhere('creator = :creator')
                ->setParameter('creator', $filters['creator']);
        }

        return $queryBuilder;
    }

    /**
     * Get or create new query builder.
     *
     * @param QueryBuilder|null $queryBuilder Query builder
     *
     * @return QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder('book');
    }
}
