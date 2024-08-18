<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FactoringController extends AbstractController
{
    /*
        TODO:
        - POST /api/factorings

        - payload:
        {
            number: string; // not blank
            total: float; // positive
            paymentDate: string; // date
            attachments: [
                {
                    id: string; // uuid
                    types: string[]; // not blank, invoice|cmr|order|other
                    filename: string; // not blank
                }
            ];
        }

        - return: Invoice

        - use SwService
    */
}
