<?php

use App\Entity\Transfer;
use Symfony\Component\OptionsResolver\OptionsResolver;
// ...

class TransferType extends AbstractType
{
    // ...

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transfer::class,
        ]);
    }
}
