<?php

namespace App\Controller;

use App\Entity\Cd;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailleCDController extends AbstractController
{
    #[Route('/cd/details', name: 'cd_details')]
    public function details(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le paramètre "titre" de la requête
        $titre = $request->query->get('titre');

        if (!$titre) {
            return $this->render('cd/error.html.twig', [
                'message' => 'Titre non fourni.'
            ]);
        }

        // Rechercher le CD dans la base de données
        $cd = $entityManager->getRepository(Cd::class)->findOneBy(['titre' => $titre]);

        if (!$cd) {
            return $this->render('cd/error.html.twig', [
                'message' => 'CD introuvable.'
            ]);
        }

        // Rendre la vue avec les détails du CD
        return $this->render('cd/details.html.twig', [
            'cd' => $cd,
        ]);
    }
}