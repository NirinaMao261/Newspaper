<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
<<<<<<< Updated upstream
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
=======
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
>>>>>>> Stashed changes

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< Updated upstream
            ->add('name')
            ->add('alias')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
=======
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max' => 100
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['category'] ? "Modifier " . $options['category']->getName() : "Ajouter",
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto my-3 col-6 btn btn-primary',
                ],
            ])
>>>>>>> Stashed changes
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
<<<<<<< Updated upstream
        ]);
    }
}
=======
            'category' => null
        ]);
    }
}
>>>>>>> Stashed changes
