<?php

namespace App\Controller\Admin;

use App\Form\CompanySearchType;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Throwable;

class CompanyController extends AbstractController
{
    #[Route('/', name: 'companyIndex')]
    public function index(Request $request, CompanyService $service, UrlGeneratorInterface $urlGenerator): Response
    {
        try {
            $company = null;
            $error = null;
            $url = $urlGenerator->generate('companyIndex');
            $form = $this->createForm(CompanySearchType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $ico = $form->getData()['ico'];
                $company = $service->getCompany($ico);

                if ($company === null) {
                    $error = "Company with given ICO: {$ico} was not found";
                }

                return $this->render('company/index.html.twig', [
                    'form' => $form->createView(),
                    'company' => $company,
                    'error' => $error,
                    'url' => $url,
                ]);
            }

            return $this->render('company/index.html.twig', [
                'form' => $form->createView(),
                'company' => $company,
                'error' => $error,
                'url' => $url
            ]);
        } catch (Throwable $t) {
            // TODO log error using monolog logger interface
            return $this->render('company/index.html.twig', [
                'form' => null,
                'company' => null,
                'error' => 'An error ocurred, try again later',
                'url' => $urlGenerator->generate('companyIndex'),
            ]);
        }
    }
}
