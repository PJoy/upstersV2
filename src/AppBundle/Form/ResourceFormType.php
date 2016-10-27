<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category', TextType::class, [
                'label' => 'Métier'
            ])
            ->add('company')
            ->add('address')
            ->add('GPSLat')
            ->add('GPSLong')
            ->add('website')
            ->add('description')
            ->add('phone')
            ->add('email')
            ->add('openingTime')
            ->add('facebook')
            ->add('twitter')
            ->add('linkedin')
            ->add('tags');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Resource'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_resource_form_type';
    }
}
