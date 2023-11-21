<?php

namespace App\Service;

use SimpleXMLElement;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class AresService
{
    public function __construct(#[Autowire(env: 'ARES_BASE_URL')] protected string $baseUrl)
    {
    }

    public function findCompanyByIco(int $ico): array
    {
        $xml = new SimpleXMLElement(file_get_contents($this->baseUrl . '?ico=' . $ico));

        $namespaces = $xml->getNamespaces(true);
        $are = $xml->children($namespaces['are']);

        // TODO implement branchOfBusiness

        return [
            'name' => (string) $are->Odpoved->Zaznam->Obchodni_firma,
            'createdAt' => (string) $are->Odpoved->Zaznam->Datum_vzniku,
        ];
    }
}
