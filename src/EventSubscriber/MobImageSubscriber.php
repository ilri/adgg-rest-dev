<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class MobImageSubscriber
{
    private $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }

}