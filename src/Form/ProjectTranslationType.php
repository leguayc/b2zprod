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
                'mapped' => false
            ))
            ->add('description', TextareaType::class, array(
                'mapped' => false
            ))
            ->add('section1title', TextType::class, array(
                'mapped' => false,
                'label' => 'Section 1 - Title'
            ))
            ->add('section1text', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Section 1 - Text'
            ))
            ->add('section2title', TextType::class, array(
                'mapped' => false,
                'label' => 'Section 2 - Title'
            ))
            ->add('section2text', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Section 2 - Text'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
