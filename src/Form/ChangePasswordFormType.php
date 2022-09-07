<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentpassword', PaswordType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Mot de passe actuel"
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'false',
                    'attr' =>[
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Nouveau mot de passe',
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'label' => 'false',
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Répétez mot de passe'
                    ],    
                ],
                'invalid_message' => 'Les mots de passe ne sont pas identiques',

            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Changer mon mot de passe',
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto col-3 my-3 btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
