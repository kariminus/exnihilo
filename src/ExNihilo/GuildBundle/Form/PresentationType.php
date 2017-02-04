<?php

namespace ExNihilo\GuildBundle\Form;

use ExNihilo\GuildBundle\Entity\ImagePresentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',                CkeditorType::class)
            ->add('imagePresentations', CollectionType::class, array(
                'entry_type'   => ImagePresentationType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ExNihilo\guildBundle\Entity\Presentation'
        ));
    }
}