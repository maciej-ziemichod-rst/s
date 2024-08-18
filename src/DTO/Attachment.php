<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class Attachment
{
    public function __construct(
        #[Assert\Uuid()]
        public string $id,

        #[Assert\NotBlank()]
        #[Assert\Choice(['invoice', 'cmr', 'order', 'other'])]
        public array $types,

        #[Assert\NotBlank()]
        public string $filename,
    ) {}
}
