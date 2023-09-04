<?php
/**
 * Genre ffixtures.
 */

namespace App\DataFixtures;

use App\Entity\Reservation;


/**
 * Class GenreFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class ReservationFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(10, 'reservations', function (int $i) {
            $reservation = new Reservation();
            $reservation->setEmail($this->faker->unique()->word);
            $reservation->setNick($this->faker->unique()->word);
            $reservation->setNote($this->faker->unique()->word);

            $book = $this->getRandomReference('books');
            $reservation->setBook($book);

            return $reservation;
        });

        $this->manager->flush();
    }
}
