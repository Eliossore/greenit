<?php

// src/Controller/MainController.php
namespace App\Controller;

use App\Repository\CDRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CDRepository $CDRepository, Request $request, SessionInterface $session): Response
    {
        // Récupération de tous les CD
        $cds = $CDRepository->findAll();

        // Récupérer le panier de la session
        $cart = $session->get('cart', []);

        // Si un produit est ajouté au panier
        if ($request->query->get('add_to_cart')) {
            $cdId = $request->query->get('add_to_cart');
            if (!isset($cart[$cdId])) {
                $cart[$cdId] = 1; // Si le CD n'est pas encore dans le panier, on l'ajoute avec une quantité de 1
            } else {
                $cart[$cdId] += 1; // Si le CD est déjà dans le panier, on augmente la quantité
            }
            // Sauvegarder le panier dans la session
            $session->set('cart', $cart);
        }

        return $this->render('main/index.html.twig', [
            'cds' => $cds,
            'controller_name' => 'MainController',
            'cart' => $cart, // Passer le panier à la vue
        ]);
    }

    // Une autre route pour afficher le panier
    #[Route('/panier', name: 'app_cart')]
    public function viewCart(SessionInterface $session, CDRepository $CDRepository): Response
    {
        // Récupérer le panier
        $cart = $session->get('cart', []);
        return $this->render('main/cart.html.twig', [
            'cart' => $cart,
        ]);
    }
}

