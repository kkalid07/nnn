<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Dislikes;
use App\Entity\Likes;
use App\Entity\Publication;
use App\Form\CommentaireType;
use App\Form\PublicationType;
use App\Repository\LikesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    /**
     * @Route("/home", name="app_publication")
     */
    public function index(): Response
    {
        return $this->render('publication/index.html.twig', [
            'controller_name' => 'PublicationController',
        ]);
    }

    /**
     * @Route("/listPubs", name="listPubs")
     */
    public function listPubs(): Response
    {
        $pubs = $this->getDoctrine()->getRepository(Publication::class)->findAll();
        return $this->render('publication/list.html.twig', array("pubs"=>$pubs));
    }

    /**
     * @Route("/pubDetail/{id}", name="pubDetail")
     */
    public function pubDetail($id): Response
    {
        $pub = $this->getDoctrine()->getRepository(Publication::class)->find($id);
        return $this->render('publication/pubDetail.html.twig', ['pub' => $pub]);
    }



    /**
     * @Route("/addPub", name="addPub")
     */
    public function addPub(Request $request): Response
    {

        $pub=new Publication();
        $pub->setDateCreation(new \DateTime());
        $form=$this->createForm(PublicationType::class,$pub);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();
            return $this->redirectToRoute('listPubs');

        }
        return $this->render("publication/add.html.twig",array('form'=>$form->createView()));
    }

    /**
     * @Route("/deletePub/{id}", name="deletePub")
     */
    public function deletePub($id): Response
    {
        $pub = $this->getDoctrine()->getRepository(Publication::class)->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($pub);
        $em->flush();
        return $this->redirectToRoute('listPubs');
    }

    /**
     * @Route("/updatePub/{id}", name="updatePub")
     */
    public function updatePub(Request $request,$id): Response
    {

        $pub= $this->getDoctrine()->getRepository(Publication::class)->find($id);
        $pub->setUpdateAt(new \DateTime());
        $form=$this->createForm(PublicationType::class, $pub);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            /*$em->persist($pub);*/
            $em->flush();
            return $this->redirectToRoute('listPubs');

        }
        return $this->render("publication/update.html.twig",array('f'=>$form->createView()));
    }


    //partie commentaires sur une publication($id)
    /**
     * @Route("/addCom2", name="add_commentaire")
     */
    public function addCom(Request $request): Response
    {
        $ref = $request->headers->get('referer');

        $pub = $this->getDoctrine()
            ->getRepository(Publication::class)
            ->findPostByid($request ->request->get('pub_id'));

        $com=new Commentaire();
        $com->setCreated(new \DateTime());
        $com->setPub($pub);
        $com->setContenuCom($request->request->get('comment'));

            $em=$this->getDoctrine()->getManager();
            $em->persist($com);
            $em->flush();
            //return $this->redirectToRoute('listPubs');


        return $this->redirect($ref);
    }

    //likes & dislikes

    /**
     * @Route("/addLike", name="add_like")
     */
    public function likeAction(Request $request) : Response
    {
        $ref = $request->headers->get('referer');

        $pub = $this->getDoctrine()
            ->getRepository(Publication::class)
            ->findPostByid($request ->request->get('pub_id'));

        $like=new Likes();
        $like->setPub($pub);


        $em=$this->getDoctrine()->getManager();
        $em->persist($like);
        $em->flush();
        //return $this->redirectToRoute('listPubs');


        return $this->redirect($ref);
    }

    /**
     * @Route("/addDisLike", name="add_dislike")
     */
    public function dislikeAction(Request $request) : Response
    {
        $ref = $request->headers->get('referer');

        $pub = $this->getDoctrine()
            ->getRepository(Publication::class)
            ->findPostByid($request ->request->get('pub_id'));

        $dislike=new Dislikes();
        $dislike->setPub($pub);


        $em=$this->getDoctrine()->getManager();
        $em->persist($dislike);
        $em->flush();
        //return $this->redirectToRoute('listPubs');


        return $this->redirect($ref);
    }


}
