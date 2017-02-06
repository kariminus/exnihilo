<?php

namespace ExNihilo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('_username', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom d\'utilisateur',
                )
            ))
            ->add('_password', PasswordType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Mot de passe',
                )
            ))
        ;

    }
}