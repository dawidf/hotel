<?php

namespace Hotel\AdminBundle\Controller;

use abeautifulsite\SimpleImage;
use Hotel\AdminBundle\Form\FileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package Hotel\AdminBundle\Controller
 *
 */
class DefaultController extends Controller
{
    /**
     * @Route("/fileTest")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        $asd = new UploadedFile();
//        $asd->getClientOriginalExtension();
//        $asd->guessExtension();
//        $asd->getClientOriginalName();

//


        $savePath = $this->get('kernel')->getRootDir().'/../web/uploads/';

        $form = $this->createForm(new FileType());


        if($request->isXmlHttpRequest())
        {
            $form->handleRequest($request);
            $files = $form->get('files')->getData();


            foreach($request->files as $file)
            {

                $orgName = $file->getClientOriginalName();

                $asd = rand(1,9999);
                $newName = $asd.$orgName;


                $fullPath = $savePath.$newName;
                $file->move($savePath, $newName);

                $image = new SimpleImage($fullPath);
                $image->thumbnail(100);

                $image->save($savePath.'mini/'.$newName);

                $image = new SimpleImage($fullPath);
                $image->best_fit(600, 9999);
                $image->save($savePath.'medium/'.$newName);

                return new JsonResponse(['uploaded' => 'ok']);
            }

        }

        return array(
            'form' => $form->createView()
        );
    }

    private function setNameIfExist($fileFullPath, $count)
    {

        if(file_exists($fileFullPath))
        {
            $this->setNameIfExist();
        }

    }
}
