<?php

namespace App\DTO;

class Invoice
{
    public function __construct(
        public int $id,
        public string $number,
        public float $total,
        public string $paymentDate,
        public array $attachments,
    ) {}
}
