<?php
/**
 * Publisher fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Publisher;

/**
 * Class PublisherFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class PublisherFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(10, 'publishers', function (int $i) {
            $publisher = new Publisher();
            $publisher->setPublisherTitle($this->faker->unique()->word);

            return $publisher;
        });

        $this->manager->flush();
    }
}
