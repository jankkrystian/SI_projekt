<?php
/**
 * Book type.
 */

namespace App\Form\Type;

use App\Entity\Book;
use App\Entity\Creator;
use App\Entity\Publisher;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BookType.
 */
class BookType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array<string, mixed> $options Form options
     *
     * @see FormTypeExtensionInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => true,
                'attr' => ['max_length' => 64],
            ])
        ->add(
            'genre',
            EntityType::class,
            ['class'=>Genre::class,
                'choice _label'=>function ($genre): string {
                return $genre->getGenreTitle();
                },
                'label'=>'label_genre_title',
                'placeholder'=>'label.genre_title',
                'required'=>true,

            ]
        )
            ->add(
                'publisher',
                EntityType::class,
                ['class'=>Publisher::class,
                    'choice _label'=>function ($publisher): string {
                        return $publisher->getPublisherTitle();
                    },
                    'label'=>'label_publisher_title',
                    'placeholder'=>'label.publisher_title',
                    'required'=>true,

                ]
            )
            ->add(
                'creator',
                EntityType::class,
                ['class'=>Creator::class,
                    'choice _label'=>function ($creator): string {
                        return $creator->getPublisherTitle();
                    },
                    'label'=>'label_creator_title',
                    'placeholder'=>'label.creator_title',
                    'required'=>true,

                ]
            )
        ;
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Book::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'book';
    }
}
