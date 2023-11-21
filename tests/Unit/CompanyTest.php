<?php

namespace App\Tests\Entity;

use App\Entity\Company;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testSetAndGetIco(): void
    {
        $company = new Company();
        $ico = 123456789;

        $company->setIco($ico);
        $this->assertSame($ico, $company->getIco());
    }

    public function testSetAndGetName(): void
    {
        $company = new Company();
        $name = 'Example Company';

        $company->setName($name);
        $this->assertSame($name, $company->getName());
    }

    public function testSetAndGetBranchOfBusiness(): void
    {
        $company = new Company();
        $branch = 'Some Business';

        $company->setBranchOfBusiness($branch);
        $this->assertSame($branch, $company->getBranchOfBusiness());
    }

    public function testGetAndSetCreatedAt(): void
    {
        $company = new Company();
        $createdAt = new DateTimeImmutable('2023-01-01');

        $company->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $company->getCreatedAt());
    }

    public function testIdInitiallyIsNull(): void
    {
        $company = new Company();
        $this->assertNull($company->getId());
    }

    public function testCreatedAtInitiallySetToNow(): void
    {
        $company = new Company();
        $this->assertInstanceOf(DateTimeInterface::class, $company->getCreatedAt());
    }
}
