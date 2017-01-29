<?php

namespace ExNihilo\GuildBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',                CkeditorType::class)
            ->add('imagePresentation',      ImagePresentationType::class)
            ->add('image2Presentation',     Image2PresentationType::class)
            ->add('image3Presentation',     Image3PresentationType::class)
            ->add('image4Presentation',     Image4PresentationType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ExNihilo\guildBundle\Entity\Presentation'
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