<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ResgisterGroup extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('semestre',TextType::class,array(
            'label'=>'Semestre'
        ))
        ->add('grupo',TextType::class,array(
            'label'=>'Grupo'
        ))
        ->add('turno',ChoiceType::class,array(
            'label'=>'Turno',
            'choices'=>array(
                'Matutino'=>'Matutino',
                'Vespertino'=>'Vespertino',
                'Mixto'=>'Mixto',
            )
        ))
        ->add('submit',SubmitType::class,array(
            'label'=>'Guardar'
        ));
    }
}
