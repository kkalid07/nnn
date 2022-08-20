<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Publication;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="app_commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }}
/*
    /**
     * @Route("/listComs", name="listComs")
     */
    /*public function listComs(): Response
    {
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();
        return $this->render('commentaire/listc.html.twig', array("coms"=>$coms));
    }

    /**
     * @Route("/addCom", name="addCom")
     */
    /*public function addCom(Request $request): Response
    {
        $pub = $this->getDoctrine()
            ->getRepository(Publication::class)
            ->findPostByid($request ->request->get('Pub_id'));



        $com=new Commentaire();
        $com->setPub($pub);
        $form=$this->createForm(CommentaireType::class,$com);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($com);
            $em->flush();
            return $this->redirectToRoute('listPubs');

        }
        return $this->render("publication/add.html.twig",array('form'=>$form->createView()));
    }

    /**
     * @Route("/deleteCom/{id}", name="deleteCom")
     */
    /*public function deleteCom($id): Response
    {
        $com = $this->getDoctrine()->getRepository(Commentaire::class)->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute('listComs');
    }
}
