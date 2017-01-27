<?php

namespace ExNihilo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('_username')
            ->add('_password', PasswordType::class)
        ;

    }
}