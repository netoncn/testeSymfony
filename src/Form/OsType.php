<?php

namespace App\Form;

use App\Entity\Os;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('Sequence')
            ->add('desconto')
            // ->add('valor_total')
            ->add('data_servico')
            ->add('tecnico')
            ->add('ferramenta')
            ->add('servico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Os::class,
        ]);
    }
}
