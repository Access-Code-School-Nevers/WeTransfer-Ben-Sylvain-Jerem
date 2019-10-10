<?php

namespace App\Form;

use App\Entity\Transfer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TransferFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('authorMail')
            ->add('receiverMail')
            ->add('message')
            // ->add('dataLink')
            ->add('file', FileType::class)
            ->add('send', SubmitType::class, [
    'label' => 'Submit',
    'label_translation_parameters' => [
        '%company%' => 'ACME Inc.',
    ],
    ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transfer::class,
        ]);
    }
}
