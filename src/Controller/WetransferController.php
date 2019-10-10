<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transfer;
use App\Form\TransferFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class WetransferController extends AbstractController
{
    /**
     * @Route("/wetransfer", name="wetransfer")
     */

    public function new(Request $request)
    {
        dump($request);
        $task = new Transfer();
        // ...

        $form = $this->createForm(TransferFormType::class, $task);

        return $this->render('wetransfer/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'WetransferController',
        ]);
        if ($form->isSubmitted() && $form->isValid()) {
       $someNewFilename =

       $file = $form['attachment']->getData();
       $file->move($directory, $someNewFilename);
     }
    }
    /**
     * @Route("/wedownload", name="wedownload")
     */
     public function download()
     {
       return $this->render('wetransfer/receiver.html.twig',
              ['controller_name' => 'WetransferController']);
     }
}
