<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AddressBookEntry extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', null, ['required' => true])
            ->add('lastName')
            ->add('street')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('phoneNumber')
            ->add('birthday', DateTimeType::class, ['widget' => 'single_text'])
            ->add('email')
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please Upload a valid image'
                    ])
                ]
            ])
            ->add('Save Address', SubmitType::class, ['label' => 'Create Address', 'attr' => ['class' => 'btn btn-primary']]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Address::class]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_address_book_entry';
    }
}
