<?php

namespace App\Controller;

use App\Repository\CDRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
set_time_limit(300);

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CDRepository $CDRepository): Response
    {
        $cds = $CDRepository->findAll();
        return $this->render('main/index.html.twig', [
            'cds' => $cds,
            'controller_name' => 'MainController',
        ]);
    }
}
