<?php

namespace App\Helpers;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BlobHelper {
    private $params;
    private SluggerInterface $slugger;

    public function __construct(ParameterBagInterface $params, SluggerInterface $slugger)
    {
        $this->params = $params;
        $this->slugger = $slugger;
    }

    /// Example of how to use this helper
    /*  
        $file = $form->get('image')->getData();
        if ($file) {
            $newFilename = $blobHelper->uploadFile($file, 'blogposts_directory');
            $entity->setImageName($newFilename);
        }
    */
    
    public function uploadFile(UploadedFile $file, string $directoryName): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        
        // Move the file to the directory where brochures are stored
        try {
            $file->move(
                $this->params->get($directoryName),
                $newFilename
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $newFilename;
    }

    public function deleteFile(string $fileName, string $directoryName, bool $isPublic = true): void
    {
        $path = $this->params->get($directoryName) . '/' . $fileName;
        if(file_exists($path)) unlink($path);
    }
}