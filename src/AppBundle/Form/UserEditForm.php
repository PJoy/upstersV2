<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstName')
            ->add('lastName')
            ->add('nationality')
            ->add('gender', ChoiceType::class, [
                'choices' => array(
                    'Homme' => 'M',
                    'Femme' => 'F',
                    'Autre' => 'O'
                )
            ])
            /*->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Entrepreneur' => 'ROLE_ENTREPRENEUR',
                    'Prestataire' => 'ROLE_RESOURCE'
                ),
                'multiple' => true,
                'expanded' => true
            ))*/
            ->add('birthDate')
            ->add('pitch')
            ->add('image', FileType::class, array(
                'data_class' => null,
                'required' => false,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_user_edit_form';
    }
}





