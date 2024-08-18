<?php

namespace App\DTO;

use Symfony\Component\Uid\UuidV4;

class AttachmentId
{
    public function __construct(
        public string $id
    ) {}

    public static function create(): AttachmentId
    {
        return new self((string) new UuidV4());
    }

    public function getId(): string
    {
        return $this->id;
    }
}
