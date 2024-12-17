<?php

namespace App\Controller;

use App\Entity\Cd;
use App\Repository\CDRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DetailleCDController extends AbstractController
{
    #[Route('/cd/details/{id}', name: 'cd_details', requirements: ['id' => '\d+'])]
    public function details(CDRepository $CDRepository,Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le paramètre "titre" de la requête
        $titre = $request->query->get('titre');

        if (!$titre) {
            return $this->render('detaille_cd/error.html.twig', [
                'message' => 'Titre non fourni.'
            ]);
        }

        // Rechercher le CD dans la base de données
        $cd = $CDRepository->findOneBy(['titre' => $titre]);

        if (!$cd) {
            return $this->render('detaille_cd/error.html.twig', [
                'message' => 'CD introuvable.'
            ]);
        }

        // Rendre la vue avec les détails du CD
        return $this->render('detaille_cd/index.html.twig', [
            'cd' => $cd,
        ]);
    }
}