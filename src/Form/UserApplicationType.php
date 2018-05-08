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
            ->add('name', null, ['attr' => ['class' => 'input_green', 'placeholder' => 'Имя']])
            ->add('email', null, ['attr' => ['class' => 'input_green', 'placeholder' => 'Email']])
            ->add('phone', null, ['attr' => ['class' => 'input_green', 'placeholder' => 'Телефон']])
            ->add('info' , TextareaType::class, ['label' => 'Доп. иформация', 'attr' => ['class' => 'input_green']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserApplication::class,
        ]);
    }
}
