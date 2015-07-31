<?php

namespace Hotel\FileManagerBundle\Controller;

use Hotel\FileManagerBundle\FileManager\ListFile;
use Hotel\FileManagerBundle\Form\AddImagesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Range;


class FileManagerController extends Controller
{

    /**
     * @return array
     * @Route("/test")
     * @Template()
     */
    public function testAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('files', 'file', array(
                'attr' => array(
                    'multiple' => true
                )
            ))
            ->add('add image', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ))
            ->getForm();

        $form->handleRequest($request);


        if($request->isMethod('POST'))
        {
            if($form->isValid())
            {
                $filesHadndled = $form->get('files')->getData();
                var_dump($filesHadndled);
                foreach ($filesHadndled as $files)
                {
                    var_dump($files);
                }


            }


        }

        return array(
            'filesHadndled' => isset($filesHadndled) ? $filesHadndled : NULL,
            'form' => $form->createView(),

        );
    }

    /**
     * @Route("/test2")
     */
    public function test2Action()
    {
        $dirs = $this->get('components_gallery.file_manager.list_file');
        $dirs->setGalleryDirName('gallery');
        $listingDirs = $dirs->listingDirs();



        return new Response('<html>Dupa</html>');
    }

//    /**
//     * @Route("/files-list")
//     */
//    public function getFilesListAction($path)
//    {
//
//        if($path === "")
//        {
//            $path = $this->get('kernel')->getRootDir().'/../web/uploads/gallery';
//        }
//
//        $filesList = new \DirectoryIterator($path);
//
//
//        $fileName = array();
//        foreach($filesList as $key => $file)
//        {
//            if($file->isFile())
//            {
//               $fileName[$key] = $file->getFilename());
//            }
//        }
//
//
//        return array(
//            'files' => $filesList
//        );
//    }

    /**
     *
     * @Route("/files-list/{path}", defaults={"path" = ""}, name="files_list")
     */
    public function getFilesListAction($path)
    {
        $fileManager = $this->get('components_gallery.file_manager.list_file');
        $fileManager->setGalleryDirName($path);

        $fileListing = $fileManager->listingFile();



        return new JsonResponse($fileListing);
    }


    /**
     * @Route("/dirs-list", name="dirs_list")
     */
    public function getDirListAction()
    {

        return $this->get('components_gallery.file_manager.list_file')->listingDirs();
    }

    /**
     * @Route("/file-manager", name="file_manager")
     * @Template()
     */
    public function fileManagerAction()
    {



        $path = $this->get('kernel')->getRootDir().'/../web/uploads';


        $dirs = new Finder();
        $dirs->directories()->in($path);

        $files = new Finder();

        $files->files()->in($path);

        $path = '';


        return array(
            'dirs' => $this->getDirListAction($path),
            'files' => $this->getFilesListAction($path),

        );
    }

    /**
     * @param $path
     *
     * @return \DirectoryIterator
     *
     * @Route("get-path/{path}", name="get_path_component")
     *
     */
    public function _getPathAction($path)
    {

        $pattern = '/\+/';
        $path = preg_replace($pattern, '/', $path);
        var_dump($path);
        $currentPath = new \DirectoryIterator($path);

        var_dump($currentPath->getRealPath());

        return array('currentPath' => $currentPath);
    }
}
