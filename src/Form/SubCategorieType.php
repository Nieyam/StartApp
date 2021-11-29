<?php

namespace App\Form;

use App\Entity\SubCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dranken')
            ->add('warme_dranken')
            ->add('hapjes')
            ->add('voorgerecht')
            ->add('hoofdgerecht')
            ->add('nagerecht')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubCategorie::class,
        ]);
    }
}
