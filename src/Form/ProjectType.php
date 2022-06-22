<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide',
                    ])
                ],
            ))
            ->add('trailer', TextType::class, array(
                'label' => 'Lien vidéo'
            ))
            ->add('pressKit', FileType::class, array(
                'mapped' => false,
                'label' => 'Dossier Presse',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '20480k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/xpdf'
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un dossier de presse valide (PDF)',
                    ])
                ],
            ))
            ->add('distributorLink', TextType::class, array(
                'mapped' => false,
                'label' => 'Lien ditributeur'
            ))
            ->add('date', DateType::class, array(
                'mapped' => false,
                'label' => 'Date'
            ))
            ->add('filmmakerFullName', TextType::class, array(
                'mapped' => false,
                'label' => 'Réalisateur'
            ))
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
                'label' => 'Section 1 - Titre'
            ))
            ->add('section1text', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Section 1 - Texte'
            ))
            ->add('section2title', TextType::class, array(
                'mapped' => false,
                'label' => 'Section 2 - Titre'
            ))
            ->add('section2text', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Section 2 - Texte'
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
