<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\UploadInvoiceAttachment;
use App\Service\SwService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UploadInvoiceAttachmentHandler
{
    public function __construct(
        private SwService $swService,
    ) {}

    public function __invoke(UploadInvoiceAttachment $message): void
    {
        $this->swService->addAttachmentToInvoice(
            $message->invoiceId,
            $message->attachmentId,
            $message->types,
            $message->filename
        );
    }
}
