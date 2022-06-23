<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProjectTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, array(
                'mapped' => false,
                'label' => 'Titre'
            ))
            ->add('description', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Description'
            ))
            ->add('section1title', TextType::class, array(
                'mapped' => false,
                'label' => 'Section 1 - Titre (Scénario)'
            ))
            ->add('section1text', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Section 1 - Texte (Liste de noms) : Faites un retour à la ligne pour un nouvel élément de la liste'
            ))
            ->add('section2title', TextType::class, array(
                'mapped' => false,
                'label' => 'Section 2 - Titre (Acteurs)'
            ))
            ->add('section2text', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Section 2 - Texte (Liste) : Faites un retour à la ligne pour un nouvel élément de la liste'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
