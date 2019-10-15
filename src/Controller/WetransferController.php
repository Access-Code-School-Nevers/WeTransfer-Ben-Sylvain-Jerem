<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// verifie les deux ces eux qui capture ton fichier et pas request regarde le debogueur
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Doctrine\Common\Persistence\ObjectManager;
use PhpZip\Model\ZipEntry;
use PhpZip\ZipFile;
use App\Entity\Transfer;
use App\Form\TransferFormType;
use App\Service\FileUploader;
use App\Repository\TransferRepository;

class WetransferController extends AbstractController
{
    /**
     * @Route("/", name="wetransfer")
     */

    public function wetransfer(Request $request, ObjectManager $manager)
    {
        dump($request);

        // $zipFile = new ZipFile();
        $task = new Transfer();

        $zip = new \PhpZip\ZipFile();

        $form = $this->createForm(TransferFormType::class, $task);

        $form->handleRequest($request);

        dump($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // capture du fichier envoyer dans une variable


          /** @var UploadedFile $fileForm */
          $fileForm = $form['file']->getdata();
          $fileName = pathinfo($fileForm->getClientOriginalName(), PATHINFO_FILENAME);

          $zip->addFile($fileForm)
              ->close();

              // ->move($this->getParameter('upload_file'))

          $task = $form->getdata();


          $linkFile = $this->generateUrl('wedownload');

          $task->setDataLink($linkFile);

          $manager->persist($task);
          $manager->flush();

          // sendMail($form['authorEmail'],$form["receiverMail"],$form["message"],$linkFile);
         }


        return $this->render('wetransfer/index.html.twig', [
          'form' => $form->createView(),
          'controller_name' => 'WetransferController',
          // 'nameFile' => pathinfo($fileForm->getClientOriginalName(), PATHINFO_FILENAME)
        ]);
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
