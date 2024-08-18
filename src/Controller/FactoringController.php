<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\InvoicePayload;
use App\Message\UploadInvoiceAttachment;
use App\Service\SwService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class FactoringController extends AbstractController
{
    use HandleTrait;

    public function __construct(
        private SwService $swService,
        MessageBusInterface $messageBus,
    ) {
        $this->messageBus = $messageBus;
    }

    #[Route(path: '/api/factorings', methods: ['POST'])]
    public function addInvoice(
        #[MapRequestPayload] InvoicePayload $invoicePayload,
    ): Response {
        $invoice = $this->swService->addInvoice($invoicePayload->number, $invoicePayload->total, $invoicePayload->paymentDate);

        foreach ($invoicePayload->attachments as $attachment) {
            $this->handle(
                new UploadInvoiceAttachment(
                    $invoice->id,
                    $attachment->id,
                    $attachment->types,
                    $attachment->filename
                )
            );
        }

        return $this->json(
            $invoice,
            202
        );
    }
}
