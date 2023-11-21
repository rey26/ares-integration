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

    public function getCompanyOrLoadFromAresApi(int $ico): ?Company
    {
        $company = $this->companyRepository->findOneBy(['ico' => $ico]);

        if ($company === null) {
            $company = CompanyFactory::createFromAresArray($ico, $this->aresService->findCompanyByIco($ico));
            $this->em->persist($company);
            $this->em->flush();
        }

        return $company;
    }
}
