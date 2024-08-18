<?php

declare(strict_types=1);

namespace App\Message;

class UploadInvoiceAttachment
{
    public function __construct(
        public int $invoiceId,
        public string $attachmentId,
        public array $types,
        public string $filename,
    ) {}
}
