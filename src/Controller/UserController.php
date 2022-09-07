<?php

namespace App\Controller;


use DateTime;
use App\Entity\Article;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/profile')]
class UserController extends AbstractController
{
    #[Route('/voir-mon-compte', name: 'show_profile', methods: ['GET'])]
    public function showProfile(EntityManagerInterface $entityManager): Response
    {
        $article = $entityManager->getRepository(Article::class)->findBy(['author' => $this->getUser()]);

        return $this->render('user/show_profile.html.twig', [
            'articles' => $articles

        ]);

    }
    #[Route('/changer-mon-mot-de-passe', name: 'change_password', methods: ['GET', 'POST'])]
    public function changePassword(Request $request, UserRepository $userRepository, UserPasswordHasher $passwordHasher): Response
    {
        $form = $this->createForm(ChangePasswordFromType::class)
        ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $currentPasswordHasher = $passwordHasher->hashPassword(
                $user, $form->get('current_password')->getData()
            );

            if($currentPasswordHasher === $user->getPassword()) {
                // dd($currentPasswordHasher)
            }


            # Récuperation en BDD su $user, cela nous permet d'utiliser les méthodes
            # de notre entité User (ex: $user->setUpdatedAT())
            $user = $repository->find($this->getUser());

            $currentPassword = $form->get('currentPassword')->getData();

            # On devra utiliser isPasswordValid() pour comparer les deux valeurs hashées 
            if( ! $passwordHasher->isPasswordValid($user, $currentPassword)) {
                $this->addFlash('warning',"Le motde passe actuel n'est pas valide");
                return $this->redirectToRoute('show_profile');
            }

            $user = $setUpdatedAt(new DateTime());

            # Variabilisation de la valeur
            $plainPassword =  $form->get('plainPassword')->getData();
            $user->setPassword($passwordHasher->hashPassword(
                $user, $plainPassword
            ));

            $repository->add($user, true);

            $this->addFlash('success', "Votre mot de passe a bien été changé");
            return $this->redirectToRoute('show_profile');




        }

        return $this->render('security/change_password.html.twig', [
            'form' => $form->$createView()
        ]);
    } 

}// end class 