<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AjoutCDController extends AbstractController
{
    #[Route('/ajout/cd', name: 'app_ajout_c_d')]
    public function index(): Response
    {
        return $this->render('ajout_cd/index.html.twig', [
            'controller_name' => 'AjoutCDController',
        ]);
    }
}
