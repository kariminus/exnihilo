<?php

namespace ExNihilo\UserBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('classe', EntityType::class, array(
            'class' => 'ExNihiloPlatformBundle:Classe',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('n')
                    ->orderBy('n.name', 'ASC');
            },
            'choice_label' => 'name',
        ));
        $builder->add('race', EntityType::class, array(
            'class' => 'ExNihiloPlatformBundle:Race',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('n')
                    ->orderBy('n.name', 'ASC');
            },
            'choice_label' => 'name',
        ));
        $builder->add('gender', ChoiceType::class, array(
            'choices'  => array(
                'Homme' => true,
                'Femme' => false,
            ),
        ));
        $builder->add('isGuildMember');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ExNihilo\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'exnihilo_userbundle_user';
    }


}
