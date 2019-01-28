<?php

namespace App\Form;

use App\Entity\Tecnicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TecnicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cpf')
            ->add('nome_completo')
            ->add('dt_nasc')
            ->add('valor_hora')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tecnicos::class,
        ]);
    }
}
