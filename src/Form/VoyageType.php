<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomVoyage')
            ->add('Description')
            ->add('Photo')
            ->add('Prix')
            ->add('Depart', null, [
                'widget' => 'single_text'
            ])
            ->add('Retour', null, [
                'widget' => 'single_text'
            ])
            ->add('Reserver', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('Vers', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'Pays',
                'multiple' => true,
            ])
            ->add('appartient', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nomCategorie',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
