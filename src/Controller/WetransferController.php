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
use Psr\Log\LoggerInterface;

class WetransferController extends AbstractController
{
    /**
     * @Route("/wetransfer", name="wetransfer")
     */

    public function new(Request $request)
    {
        dump($request);
        $transfer = new Transfer();
        // ...

        $form = $this->createForm(TransferFormType::class, $transfer);

        return $this->render('wetransfer/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'WetransferController',
        ]);
        if ($form->isSubmitted() && $form->isValid()) {
       // $someNewFilename = ;
       $file = $form['attachment']->getData();
       $file->move($directory, $someNewFilename);
       sendMail($form['authorEmail'],$form["receiverMail"],$form["message"]);
     }
    }

    public function zipData(UploadedFile $data) {

    }

    public function sendMail($sender, $receiver, $personnalMessage) {
      $mailer = new Swift_Mailer();

      $mailSubject = "Files from ".$sender." are waiting for you!";
      $message = (new Swift_Message($mailSubject))
      ->setFrom(['send@example.com'])
      ->setTo([$receiver])
      ->setBody("this is a test")
      ;

      $mailer->send($message);

    }
}
