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
 * Class BookRepository.
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Book>
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
    public const PAGINATOR_ITEMS_PER_PAGE = 5;

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
     * @return QueryBuilder Query builder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->orderBy('book.title', 'DESC');
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
}