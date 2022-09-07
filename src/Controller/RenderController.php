<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RenderController extends AbstractController
{
    
        #[Route('/categories', name: 'render_categories_in_nav')]
        public function renderCategoriesInNav(CategoryRepository $repository): Response
    {
        $categories = $repository->findBy(['deletedAt' => null()], ['name' => 'ASC']);

        return $this->render('rendered/categories_in_nav.html.twig', [
            'categories' => $categories
        ]);
    }
}