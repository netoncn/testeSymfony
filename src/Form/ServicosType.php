<?php

namespace App\Form;

use App\Entity\Servicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServicosType extends AbstractType
{
    private $enum_tipo = array('Hidraulico'=>'Hidraulico', 'Eletrico'=>'Eletrico', 'Pintura'=>'Pintura');

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('tipo', ChoiceType::class, ['choices'  => [$this->enum_tipo], 'placeholder' => 'Tipo'])
        ->add('descricao')
            ->add('tempo_medio')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Servicos::class,
        ]);
    }

    public function getEnumTipo(){
        return $this->enum_tipo;
    }
}
