<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Invoice;

class SwService
{
    public function addInvoice(string $number, float $total, string $paymentDate): Invoice
    {
        // sw communication...

        return new Invoice(time(), $number, $total, $paymentDate, []);
    }

    public function addAttachmentToInvoice(int $invoiceId, string $attachmentId, array $types, string $filename): void
    {
        // sw communication...
    }
}
