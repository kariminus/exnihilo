<?php

namespace ExNihilo\GuildBundle\Form;

use Symfony\Component\Form\AbstractType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresentationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',         CkeditorType::class)
            ->add('guildImage1',     GuildImage1Type::class)
            ->add('guildImage2',     GuildImage2Type::class)
            ->add('guildImage3',     GuildImage3Type::class)
            ->add('guildImage4',     GuildImage4Type::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ExNihilo\GuildBundle\Entity\Presentation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'exnihilo_guildbundle_presentation';
    }


}
