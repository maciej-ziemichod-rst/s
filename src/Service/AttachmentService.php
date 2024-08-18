<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\AttachmentId;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentService implements AttachmentServiceInterface
{
    public function save(UploadedFile $file): AttachmentId
    {
        $attachmentId = AttachmentId::create();

        // file save logic

        return $attachmentId;
    }
}
