<?php

namespace App\Form;

use App\Entity\Scenario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ScenarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, array(
                'mapped' => false,
                'label' => 'Mail'
            ))
            ->add('phoneNumber', TextType::class, array(
                'mapped' => false,
                'label' => 'Téléphone'
            ))
            ->add('firstname', TextType::class, array(
                'mapped' => false,
                'label' => 'Prénom'
            ))
            ->add('lastname', TextType::class, array(
                'mapped' => false,
                'label' => 'Nom'
            ))
            ->add('file', FileType::class, array(
                'mapped' => false,
                'label' => 'Fichier'
            ))
            ->add('summary', TextType::class, array(
                'mapped' => false,
                'label' => 'Résumé'
            ))   
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Scenario::class,
        ]);
    }
}
