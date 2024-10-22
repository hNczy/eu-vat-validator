<?php

declare(strict_types=1);

namespace App\Controller;

use MLocati\Vies\CheckVat\Request;
use MLocati\Vies\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VatNumberValidatorController
{
    #[Route(
        '/validate/{vatNumber}',
        name: 'EU VAT Number Validator',
        methods: ['GET'],
    )]
    public function validate(string $vatNumber): Response
    {
        $countryCode = substr($vatNumber, 0, 2);
        $nakedVatNumber = substr($vatNumber, 2);

        $vies = new Client();
        $request = new Request($countryCode, $nakedVatNumber);
        $response = $vies->checkVatNumber($request);

        return new Response(var_export($response->getRawData(), true));
    }
}
