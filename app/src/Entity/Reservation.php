<?php
/**
 * Reservation entity.
 */

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Reservation.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Table(name: 'reservations')]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Email.
     */
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * Nick.
     */
    #[ORM\Column(length: 255)]
    private ?string $nick = null;

    /**
     * Note.
     */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    /**
     * Book.
     */
    #[ORM\ManyToOne(targetEntity: Book::class, fetch: 'EXTRA_LAZY')]
    private ?Book $book = null;

    /**
     * Primary key.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null Result
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email Email
     *
     * @return $this Result
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null Result
     */
    public function getNick(): ?string
    {
        return $this->nick;
    }

    /**
     * @param string $nick Nick
     *
     * @return $this Result
     */
    public function setNick(string $nick): static
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * @return string|null Result
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string $note Note
     *
     * @return $this Result
     */
    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Book|null Result
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @param Book|null $book Book email
     *
     * @return $this Result
     */
    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }
}
