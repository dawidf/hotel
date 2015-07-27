<?php

namespace Hotel\AdminBundle\Controller;

use Hotel\AdminBundle\Form\FileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/fileTest")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $savePath = $this->get('kernel')->getRootDir().'/../web/uploads/';

        $form = $this->createForm(new FileType());


        if($request->isXmlHttpRequest())
        {
            $form->handleRequest($request);
            $files = $form->get('files')->getData();


            foreach($request->files as $file)
            {
                $file->move($savePath);
                echo 'ok';
            }
//            foreach($files as $file)
//            {
//                $file->move($savePath);
//                echo 'success';
//            }
        }

        return array(
            'form' => $form->createView()
        );
    }
}
