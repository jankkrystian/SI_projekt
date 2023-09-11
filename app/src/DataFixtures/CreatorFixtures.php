<?php
/**
 * Creator fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Creator;

/**
 * Class CreatorFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class CreatorFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(3, 'creators', function (int $i) {
            $creator = new Creator();
            $creator->setNick($this->faker->unique()->word);
            $creator->setName($this->faker->sentence);
            $creator->setSurname($this->faker->sentence);

            return $creator;
        });

        $this->manager->flush();
    }
}
