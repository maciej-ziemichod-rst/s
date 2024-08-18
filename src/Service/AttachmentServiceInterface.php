<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\AttachmentId;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AttachmentServiceInterface
{
    public function save(UploadedFile $file): AttachmentId;
}
