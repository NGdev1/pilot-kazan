<?php

namespace App\Form;

use App\Entity\UserApplication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Имя', 'attr' => ['class' => 'input_green', 'placeholder' => 'Имя*']])
            ->add('phone', null, ['label' => 'Телефон', 'attr' => ['class' => 'input_green', 'placeholder' => 'Телефон*']])
            ->add('info' , TextareaType::class, ['required' => false, 'label' => 'Доп. иформация', 'attr' => ['class' => 'input_green', 'style' => 'min-height: 90px']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserApplication::class,
        ]);
    }
}
