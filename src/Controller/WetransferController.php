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
        $zipFile = new \PhpZip\ZipFile();

        $form = $this->createForm(TransferFormType::class, $task);
        $form->handleRequest($request);


        ]);
        if ($form->isSubmitted() && $form->isValid()) {

          $fileForm = $form['file'];
          $contents = $zipFile[$fileForm];
          $contents->move($this->getParameter('upload_file'));
          $linkFile = $this->generateUrl('wedownload');
          $task->setDataLink($linkFile);
         }


        return $this->render('wetransfer/index.html.twig', [
          'form' => $form->createView(),
          'controller_name' => 'WetransferController']);
    }
}
