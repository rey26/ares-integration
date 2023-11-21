<?php

namespace App\Service\Factory;

use App\Entity\Company;
use DateTimeImmutable;

class CompanyFactory
{
    public static function createFromAresArray(int $ico, array $companyData): Company
    {
        $company = new Company();

        $company
            ->setIco($ico)
            ->setName($companyData['name'])
            ->setBranchOfBusiness('Branch of business')
            ->setCreatedAt(new DateTimeImmutable($companyData['createdAt']))
        ;

        return $company;
    }
}
