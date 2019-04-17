<?php

namespace AppBundle\Services;


use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const PICTURE_UPLOAD_PATH = 'uploads/picture/';

    private $targetDirectory;

    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     * @return bool|string
     */
    public function uploadFile(UploadedFile $file): string
    {
        try {
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $fileName = $originalFileName.'-'.uniqid().'.'.$file->guessExtension();

            $file->move($this->getTargetDirectory(), $fileName);
        } catch (UploadException $e) {
            throw new UploadException('Unable to upload the picture.');
        }

        return $fileName;
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}