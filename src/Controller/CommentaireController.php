<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CommentaireRepository;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ArticleType;
use App\Entity\Article;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    #[Route('/listcommentaire', name: 'list_commentaire')]
    public function listcommentaire(Request $request,commentaireRepository $repository)
    {
        $commentaire= $repository->findAll();
       // $students= $this->getDoctrine()->getRepository(StudentRepository::class)->findAll()


               return $this->render("commentaire/list.html.twig",array("tabcommentaire"=>$commentaire));
    }



    #[Route('/addcommentaire', name: 'add222')]
    public function addcommentaire(ManagerRegistry $doctrine,Request $request)
    {
        $commentaire= new commentaire;
        $form= $this->createForm(CommentaireType::class,$commentaire);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
            $em= $doctrine->getManager();
             $em->persist($commentaire);
             $em->flush();
             return  $this->redirectToRoute("list_commentaire");
         }
        return $this->renderForm("commentaire/add.html.twig",array("formcommentaire"=>$form));
    }

  
  

}
