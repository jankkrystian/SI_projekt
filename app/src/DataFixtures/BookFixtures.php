<?php
/**
 * Book fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Publisher;
use App\Entity\Creator;
use App\Entity\Book;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class BookFixtures.
 */
class BookFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        if (null === $this->manager || null === $this->faker) {
            return;
        }

        $this->createMany(100, 'books', function (int $i) {
            $book = new Book();
            $book->setTitle($this->faker->sentence);
            $book->setAvailability($this->faker->randomElement(['10']));

            /** @var Genre $genre */
            $genre = $this->getRandomReference('genres');
            $book->setGenre($genre);

            /** @var Publisher $publisher */
            $publisher = $this->getRandomReference('publishers');
            $book->setPublisher($publisher);

            /** @var Creator $creator */
            $creator = $this->getRandomReference('creators');
            $book->setCreator($creator);

            /** @var User $author */
            $author = $this->getRandomReference('admins');
            $book->setAuthor($author);

            return $book;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: GenreFixtures::class, 1: PublisherFixtures::class, 2:CreatorFixtures::class, 3:UserFixtures::class}
     */
    public function getDependencies(): array
    {
        return [GenreFixtures::class, PublisherFixtures::class, CreatorFixtures::class, UserFixtures::class];
    }
}
