<?php
/**
 * Book entity.
 */

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Book.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table(name: 'books')]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 255)]
    private ?string $title = null;

    /**
     * Genre.
     */
    #[ORM\ManyToOne(targetEntity: Genre::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type(Genre::class)]
    private ?Genre $genre = null;

    /**
     * Publisher.
     */
    #[ORM\ManyToOne(targetEntity: Publisher::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type(Publisher::class)]
    private ?Publisher $publisher = null;

    /**
     * Creator.
     */
    #[ORM\ManyToOne(targetEntity: Creator::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type(Creator::class)]
    private ?Creator $creator = null;

    /**
     * Author.
     */
    #[ORM\ManyToOne(targetEntity: User::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type(User::class)]
    private ?User $author = null;

    /**
     * Availability.
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private ?int $availability = null;

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title Title
     *
     * @return $this Result
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Genre|null Result
     */
    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    /**
     * @param Genre|null $genre Genre name
     *
     * @return $this Result
     */
    public function setGenre(?Genre $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return Publisher|null Result
     */
    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    /**
     * @param Publisher|null $publisher Publisher title
     *
     * @return $this Result
     */
    public function setPublisher(?Publisher $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return Creator|null Result
     */
    public function getCreator(): ?Creator
    {
        return $this->creator;
    }

    /**
     * @param Creator|null $creator Creator nick
     *
     * @return $this Result
     */
    public function setCreator(?Creator $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return User|null Result
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author Author email
     *
     * @return $this Result
     */
    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return int|null Result
     */
    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    /**
     * @param int $availability Availability
     *
     * @return $this Result
     */
    public function setAvailability(?int $availability): static
    {
        $this->availability = $availability;

        return $this;
    }
}
