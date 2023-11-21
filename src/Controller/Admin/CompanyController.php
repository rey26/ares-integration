<?php

namespace App\Controller\Admin;

use App\Form\CompanySearchType;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    #[Route('/', name: 'companyIndex')]
    public function index(Request $request, CompanyService $service): Response
    {
        $company = null;
        $error = null;
        $form = $this->createForm(CompanySearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ico = $form->getData()['ico'];
            $company = $service->getCompanyOrLoadFromAresApi($ico);

            if ($company === null) {
                $error = "Company with given ICO: {$ico} was not found";
            }

            return $this->render('company/index.html.twig', [
                'form' => $form->createView(),
                'company' => $company,
                'error' => $error,
            ]);
        }

        return $this->render('company/index.html.twig', [
            'form' => $form->createView(),
            'company' => $company,
            'error' => $error,
        ]);
    }
}
