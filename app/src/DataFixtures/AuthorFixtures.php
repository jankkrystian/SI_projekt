<?php
/**
 * Author fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Persistence\ObjectManager;

/**
 * Class AuthorFixtures.
 */
class AuthorFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     */
    public function loadData(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $author = new Author();
            $author->setName($this->faker->sentence);
            $author->setSurname($this->faker->sentence);
            $this->manager->persist($author);
        }

        $this->manager->flush();
    }
}
