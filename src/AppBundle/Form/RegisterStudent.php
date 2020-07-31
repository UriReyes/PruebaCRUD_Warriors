<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class RegisterStudent extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('nombre',TextType::class,array(
            'label'=>'Nombre'
        ))
        ->add('apellidos',TextType::class,array(
            'label'=>'Apellidos'
        ))
        ->add('edad',NumberType::class,array(
            'label'=>'Edad'
        ))
        ->add('email',EmailType::class,array(
            'label'=>'Email'
        ))
        ->add('telefono',TextType::class,array(
            'label'=>'Telefono'
        ))
        ->add('grupo',  EntityType::class, array(
            'class' => 'AppBundle\Entity\Grupo',
            'choice_label' => 'grupo'
        ))
        ->add('submit',SubmitType::class,array(
            'label'=>'Guardar'
        ));
    }
}
