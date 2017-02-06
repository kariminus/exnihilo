<?php


namespace ExNihilo\UserBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ExNihilo\UserBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;

class UserRegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom d\'utilisateur',
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Email',
                )
            ))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class
            ])
            ->add('classe', EntityType::class, array(
                'label' => false,
                'placeholder' => 'Classe du personage',
                'class' => 'ExNihiloPlatformBundle:Classe',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.name', 'ASC');
                },
                'choice_label' => 'name',
            ))
            ->add('race', EntityType::class, array(
                'label' => false,
                'placeholder' => 'Race du personage',
                'class' => 'ExNihiloPlatformBundle:Race',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.name', 'ASC');
                },
                'choice_label' => 'name',
            ))
            ->add('gender', ChoiceType::class, array(
                'label' => false,
                'placeholder' => 'Genre du personage',
                'choices' => array(
                    'Homme' => 0,
                    'Femme' => 1,
                ),
            ))
            ->add('isGuildMember', CheckboxType::class, array(
                'label' => 'Etes vous membre de la guilde ? '
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['Default', 'Registration']
        ]);
    }


}