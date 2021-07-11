<?php

namespace ProduitBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('modele')->add('type')->add('photo',FileType::class, [
        'label' => 'Image(jpg)',
        'mapped' => false,

        'required' => false,
        'constraints' => [
            new File([
                'maxSize' => '1024k',
                'mimeTypes' => [
                    "image/jpeg","image/jpg","image/png"
                ],
                'mimeTypesMessage' => 'Please upload a valid png or jpg document',
            ])
        ],
    ])->add('tutorial',FileType::class, [
            'label' => 'Video(mp4)',
            'mapped' => false,

            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        "video/mp4","video/avi"
                    ],
                    'mimeTypesMessage' => 'Please upload a valid png or jpg document',
                ])
            ],
        ])->add('prix')->add('description')->add('qte')
            ->add('Categorie',EntityType::class,array(
                'class'=>'ProduitBundle:Categorie',
                'choice_label'=>'nom',
                'multiple'=>false
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProduitBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'produitbundle_produit';
    }


}
