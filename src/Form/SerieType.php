<?php

namespace App\Form;

use App\Entity\Serie;
use App\Entity\TypeSerie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('titreOriginal', TextType::class)
            ->add('episode', IntegerType::class)
            ->add('dureeEp', TextType::class)
            ->add('paysOrigine', CountryType::class)
            ->add('dateSortie', TextType::class)
            ->add('type_serie', EntityType::class, [
                'class'=> TypeSerie::class,
                'choice_label' => 'name'
            ])
            // ->add('status_serie_base', ChoiceType::class,)
            // ->add('genres', ChoiceType::class,)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
