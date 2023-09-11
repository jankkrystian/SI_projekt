<?php
/**
 * Genre entity.
 */

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Genre.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: GenreRepository::class)]
#[ORM\Table(name: 'genres')]
#[ORM\UniqueConstraint(name: 'uq_genres_genreTitle', columns: ['genre_title'])]
#[UniqueEntity(fields: ['genreTitle'])]
class Genre
{
    /**
     * Primary key.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Title.
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 255)]
    private ?string $genreTitle = null;

    /**
     * Slug.
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 255)]
    #[Gedmo\Slug(fields: ['genreTitle'])]
    private ?string $slug = null;

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
    public function getGenreTitle(): ?string
    {
        return $this->genreTitle;
    }

    /**
     * @param string $genreTitle Genre title
     *
     * @return $this Result
     */
    public function setGenreTitle(string $genreTitle): void
    {
        $this->genreTitle = $genreTitle;
    }

    /**
     * @return string|null Result
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug Slug
     *
     * @return $this Result
     */
    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
