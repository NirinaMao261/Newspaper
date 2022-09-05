<?php

namespace App\Controller;

use PhpParser\Builder\Method;
use Symfony\Component\Routing\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/tableau-de-bord', name: 'show-dashboard', methods ['GET'])]
    public function showDashboard(EntityManagerInterface $entityManager): Response
    {

        $articles = $entityManager->getRepository(Article::class)->findBy(['deletedAt' => null]);
        $categories = $entityManager->getRepository(Category::class)->findBy(['deletedAt' => null]);
        
        return $this->render('admin/show_dashboard.html.twig');

    }

}
