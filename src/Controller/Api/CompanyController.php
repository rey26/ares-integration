<?php

namespace App\Controller\Api;

use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class CompanyController extends AbstractController
{
    public function __construct(protected SerializerInterface $serializer)
    {
    }

    #[Route('/api/company/{ico}')]
    public function index(CompanyService $service, int $ico): JsonResponse
    {
        try {
            $company = $service->getCompany($ico);

            if ($company === null) {
                return new JsonResponse(
                    [
                        'data' => [],
                        'error' => "Company with given ICO: {$ico} was not found",
                    ],
                    404,
                );
            }

            return new JsonResponse($this->serializer->serialize($company, 'json'), 200, [], true);
        } catch (Throwable $t) {
            // TODO log error using monolog logger interface
            return new JsonResponse(['error' => 'Unknown error, try again later'], 500);
        }
    }
}
