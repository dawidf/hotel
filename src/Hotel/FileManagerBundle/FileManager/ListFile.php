<?php
/**
 * Created by PhpStorm.
 * User: ssss
 * Date: 01.06.15
 * Time: 08:15
 */

namespace Hotel\FileManagerBundle\FileManager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;



class ListFile{


    private $pathToUploads;
    private $galleryDirName;


    public function __construct(ContainerInterface $containerInterface)
    {
        $rootDir= $containerInterface->get('kernel')->getRootDir();
        $this->pathToUploads = $rootDir.'/../web/uploads';
    }



    /**
     * @param mixed $galleryDirName
     */
    public function setGalleryDirName($galleryDirName)
    {
        $this->galleryDirName = $galleryDirName;

    }

    private function getPathToFinalFolder()
    {
        return $this->pathToUploads.'/'.$this->galleryDirName;
    }


    private function isfolderNameValidAndNotEmpty()
    {
        $pattern = '/uploads\/./';
        return ($this->galleryDirName == '' || !preg_match($pattern, $this->getPathToFinalFolder()));
    }


    public function listingFile()
    {

        if($this->isfolderNameValidAndNotEmpty())
        {
            $this->pathToFolder = $this->pathToUploads;
        }

        $files = new Finder();
        $files->sortByChangedTime()->files()->in($this->getPathToFinalFolder());

        $fileNames = array();

        foreach($files as $file)
        {
            $fileNames[] = $file->getRelativePathname();
        }

        return $fileNames;
    }

    public function listingDirs()
    {


        $dirs = new Finder();

        $dirs->sortByName()->directories()->in($this->pathToUploads);
        $dirNames = array();

        foreach($dirs as $key => $dir)
        {
            $dirNames[] = $dir->getRelativePathname();



        }


        return $dirNames;
    }
}