<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchType;
use App\Services\QrcodeService;
use Symfony\Component\HttpFoundation\Request;



class HomeController extends AbstractController
{
    /**
     * @Route("/home-search", name="app_home")
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     */
    public function index(Request $request, QrcodeService $qrcodeService): Response
    {
        $qrCode = null;
        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qrCode = $qrcodeService->qrcode($data['name']);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
            'qrCode' => $qrCode
        ]);
    }
}
