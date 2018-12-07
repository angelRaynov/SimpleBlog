<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email" , TextType::class)
            ->add("password" , TextType::class)
            ->add("name" , TextType::class)
            ->add("age", TextType::class)
            ->add("phone", TextType::class)
            ->add("avatar", TextType::class)
            ->add("bio", TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
