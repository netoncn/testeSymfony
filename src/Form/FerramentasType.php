<?php

namespace App\Form;

use App\Entity\Ferramentas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FerramentasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('cod_ferramenta')
            ->add('nome_ferramenta')
            ->add('marca_ferramenta')
            ->add('aluguel_hora')
            // ->add('os')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ferramentas::class,
        ]);
    }
}
