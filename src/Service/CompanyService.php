<?php

namespace App\Service;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Service\Factory\CompanyFactory;
use Doctrine\ORM\EntityManagerInterface;

class CompanyService
{
    public function __construct(
        protected CompanyRepository $companyRepository,
        protected AresService $aresService,
        protected EntityManagerInterface $em,
    ) {
    }

    public function getCompany(int $ico): ?Company
    {
        $company = $this->companyRepository->findOneBy(['ico' => $ico]);

        if ($company === null) {
            $aresCompanyData = $this->aresService->findCompanyByIco($ico);

            if ($aresCompanyData !== null) {
                $company = CompanyFactory::createFromAresArray($ico, $aresCompanyData);
                $this->em->persist($company);
                $this->em->flush();
            }
        }

        return $company;
    }
}
