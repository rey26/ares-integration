<?php

namespace App\Tests\Kernel;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CompanyTest extends KernelTestCase
{
    public function testUniqueNameIcoConstraint(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $entityManager = $container->get(EntityManagerInterface::class);

        // Create two entities with the same name and ico number
        $company1 = (new Company())
            ->setName('Example Company')
            ->setIco(123456789)
            ->setBranchOfBusiness('Some Business');

        $company2 = (new Company())
            ->setName('Example Company')
            ->setIco(123456789)
            ->setBranchOfBusiness('Another Business');

        $entityManager->persist($company1);

        // Assert that trying to persist the second entity will throw an exception due to the unique constraint
        $this->expectException(\Doctrine\DBAL\Exception\UniqueConstraintViolationException::class);
        $entityManager->persist($company2);
        $entityManager->flush();
    }
}
