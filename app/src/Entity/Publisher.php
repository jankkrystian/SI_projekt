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
    #[ORM\Column(type:'string', length: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min:3, max: 255)]
    private ?string $publisherTitle;

    /**
     * Slug.
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 255)]
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
