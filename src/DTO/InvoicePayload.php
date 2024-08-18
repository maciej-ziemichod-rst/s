<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class InvoicePayload
{
    /**
     * @param array<Attachment> $attachments
     */
    public function __construct(
        #[Assert\NotBlank()]
        public string $number,

        #[Assert\Positive()]
        public float $total,

        #[Assert\Date()]
        public string $paymentDate,

        #[Assert\NotBlank()]
        #[Assert\Valid()]
        public array $attachments,
    ) {}
}
