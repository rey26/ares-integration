<?php

namespace App\Service;

use App\Entity\Company;
use App\Repository\CompanyRepository;

class CompanyService
{
    public function __construct(protected CompanyRepository $companyRepository)
    {
    }

    public function getCompanyOrLoadFromAresApi(int $ico): ?Company
    {
        $company = $this->companyRepository->findOneBy(['ico' => $ico]);

        return $company;
    }
}
