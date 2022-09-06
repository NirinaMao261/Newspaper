<?php

namespace App\Controller;

use DateTime;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class CategoryController extends AbstractController
{
    #[Route('/creer_une_categorie', name: 'create_category', methods: ['GET','POST'])]
    public function createCategory(Request $request, SluggerInterface $slugger, CategoryRepository $repository): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category)-> handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {

            $category->setCreatedAt(new DateTime());
            $category->setUpdatedAt(new DateTime());

            $category->setAlias($slugger->slug($category->getName()));

            $repository->add($category, true);

            $this->addFlash('success', 'La nouvelle catégorie est bien créée!');
            return $this->redirectToRoute('show_dashboard');
        }
        return $this->render('admin/form/category.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);

    } // end function update

    #[Route('/archive-une-categorie/{id)', name: 'soft_delete_category', methods:['GET'])]
    public function softDelete(Category $category, CategoryRepository $repository): Response
    {
            $category->setDeletedAt(new DateTime());

            $repository->add($category, true);

            $this->addFlash('success', 'La catégorie a bien été archové. Voir les archoves pour restaure');
            return $this->redirectToroute('show_dashboard');
    } // end function sofetDelete ()

    #[Route('/restaure-une-categorie/{id}', name: 'restore_category', methods: ['GET'])]
    public function restore(Category $category, CategoryRepository $repository): Response
    {

        $category->setDeleteAt(null);

        $repository->add($category, true);

        $this->addFlash('success', 'La catégorie a bien été restauré!');
        return $this->redirectToRoute('show_dashboard');
    }
    #[Route('/supprimer-une-categorie/{id}', name: 'hard_delete_category', methods: ['GET'])]
    public function restore(Category $category, CategoryRepository $repository): Response    
    {
        $category->setDeleteAt(null);

        $this->addFlash('success', 'La catégorie a été definitivement supprimée du systême!');
        return $this->redirectToRoute('show_dashboard');
    }

    }

}


