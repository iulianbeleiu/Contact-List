<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'label' => 'First Name',
            'attr' => ['class' => 'form-control']
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Last Name',
            'attr' => ['class' => 'form-control']
        ])
        ->add('street', TextType::class, [
            'label' => 'Street',
            'attr' => ['class' => 'form-control']
        ])
        ->add('streetNumber', TextType::class, [
            'label' => 'Street Number',
            'attr' => ['class' => 'form-control']
        ])
        ->add('zip', TextType::class, [
            'label' => 'Zip Code',
            'attr' => ['class' => 'form-control']
        ])
        ->add('city', TextType::class, [
            'label' => 'City',
            'attr' => ['class' => 'form-control']
        ])
        ->add('country', TextType::class, [
            'label' => 'Country',
            'attr' => ['class' => 'form-control']
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => 'Phone Number',
            'attr' => ['class' => 'form-control']
        ])
        ->add('birthDay', DateType::class, [
            'label' => 'Birth Day',
            'attr' => ['class' => 'form-control datetimepicker'],
            'widget' => 'single_text',
        ])
        ->add('email', EmailType::class, [
            'label' => 'E-mail',
            'attr' => ['class' => 'form-control']
        ])
        ->add('picture', FileType::class, [
            'label' => 'Picture',
            'attr' => ['class' => 'form-control-file'],
            'required' => false
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Create Contact',
            'attr' => ['class' => 'btn btn-primary']
        ]);
    }
}