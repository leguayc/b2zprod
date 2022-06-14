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

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, array(
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '5120k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image',
                    ])
                ],
            ))
            ->add('trailer', TextType::class, array(
                'label' => 'Trailer link'
            ))
            ->add('pressKit', FileType::class, array(
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '20480k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/xpdf'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid press kit (PDF)',
                    ])
                ],
            ))
            ->add('distributorLink')
            ->add('date')
            ->add('filmmakerFullName')
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
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
