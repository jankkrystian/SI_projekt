<?php
/**
 * Publisher entity.
 */

namespace App\Entity;

use App\Repository\PublisherRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Publisher.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: PublisherRepository::class)]
#[ORM\Table(name: 'publishers')]
#[ORM\UniqueConstraint(name: 'uq_publishers_publisherTitle', columns: ['publisher_title'])]
#[UniqueEntity(fields: ['publisherTitle'])]
class Publisher
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
    private ?string $publisherTitle;

    /**
     * Slug.
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 255)]
    #[Gedmo\Slug(fields: ['publisherTitle'])]
    private ?string $slug = null;

    /**
     * Getter for Id.
     *
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for title.
     *
     * @return string|null Title
     */
    public function getPublisherTitle(): ?string
    {
        return $this->publisherTitle;
    }

    /**
     * Setter for title.
     *
     * @param string|null $publisherTitle publisherTitle
     */
    public function setPublisherTitle(?string $publisherTitle): void
    {
        $this->publisherTitle = $publisherTitle;
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
