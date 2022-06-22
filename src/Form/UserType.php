<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, array(
                'label' => 'Mail'
            ))
            ->add('roles', TextType::class, array(
                'label' => 'Rôles'
            ))
            ->add('password', TextType::class, array(
                'label' => 'Mot de passe'
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
