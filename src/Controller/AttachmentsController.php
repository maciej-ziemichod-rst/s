<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AttachmentServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AttachmentsController extends AbstractController
{
    public function __construct(
        private ValidatorInterface $validator,
        private AttachmentServiceInterface $attachmentService,
    ) {}

    #[Route(methods: 'POST', path: '/api/attachments', format: 'multipart/form-data')]
    public function uploadAttachment(Request $request): Response
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        $validationErrors = $this->validator->validate(
            $file,
            [
                new File(
                    maxSize: '20M',
                    extensions: [
                        '.jpeg',
                        '.jpg',
                        '.pdf',
                        '.doc',
                        '.docx',
                        '.odt',
                        '.png',
                        '.xls',
                        '.csv',
                        'jpeg',
                        'jpg',
                        'pdf',
                        'doc',
                        'docx',
                        'odt',
                        'png',
                        'xls',
                        'csv',
                    ],
                    mimeTypes: null
                ),
            ]
        );

        if (count($validationErrors) > 0) {
            $errors = [];
            foreach ($validationErrors as $violation) {
                $errors[] = new ConstraintViolation(
                    $violation->getMessage(),
                    $violation->getMessageTemplate(),
                    $violation->getParameters(),
                    $violation->getRoot(),
                    'file',
                    $violation->getInvalidValue(),
                    $violation->getPlural(),
                    $violation->getCode(),
                    $violation->getConstraint(),
                    $violation->getCause()
                );
            }

            throw new \InvalidArgumentException(strval(new ConstraintViolationList($errors)));
        }

        $attachmentId = $this->attachmentService->save($file);

        return $this->json($attachmentId, Response::HTTP_CREATED);
    }
}
