<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PublicationJsonController extends AbstractController
{

    /**
     * @Route("/publication/json", name="app_publication_json")
     */
    public function index(): Response
    {
        return $this->render('publication_json/index.html.twig', [
            'controller_name' => 'PublicationJsonController',
        ]);
    }
    /**
     * @Route("/readPubsJson", name="readPubsJson")
     */
    public function readPubsJson(NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Publication::class);
        $pubs = $repository->findAll();

        $jsonContent = $Normalizer->normalize($pubs, 'json', ['groups'=>'post:read']);

        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/pubDetailJson/{id}", name="pubDetailJson")
     */
    public function pubDetail($id,NormalizerInterface $Normalizer): Response
    {
        $pub = $this->getDoctrine()->getRepository(Publication::class)->find($id);
        $jsonContent = $Normalizer->normalize($pub, 'json', ['groups'=>'post:read']);

        return new Response(json_encode($jsonContent));
    }


    /**
     * @Route("/addPubJson", name="addPubJson")
     *Method("POST")
     */
    public function addPubJson(Request $request,NormalizerInterface $Normalizer)
    {
        $pub = new Publication();
        $pub->setContenuPub($request->get('contenu_pub'));

        $pub->setDateCreation(new \DateTime('now'));

        $pub->setImage($request->get('image'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($pub);
        $em->flush();

        $jsonContent = $Normalizer->normalize($pub, 'json', ['groups'=>'post:read']);

        return new Response(json_encode($jsonContent));
    }


    /**
     * @Route("updatePubJson/{id}" , name="updatePubJson", methods={"PUT"})
     */
    public function updatePubJson($id,Request $request,NormalizerInterface $Normalizer)
    {
        $em=$this->getDoctrine()->getManager();
        $pub=$this->getDoctrine()->getManager()
            ->getRepository(Publication::class)
            ->find($id);

        $pub->setContenuPub($request->get("contenu_pub"));
        $pub->setUpdateAt(new \DateTime('now'));

        $em->persist($pub);
        $em->flush();
        $jsonContent = $Normalizer->normalize($pub, 'json', ['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/deletePubJson/{id}", name="deletePubJson" ,methods={"DELETE"})
     */
    public function deletePubJson($id,Request $request,NormalizerInterface $Normalizer)
    {


        $pub = $this->getDoctrine()->getRepository(Publication::class)->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($pub);
        $em->flush();
        $jsonContent = $Normalizer->normalize($pub, 'json', ['groups'=>'post:read']);
        return new Response("deleted successfully".json_encode($jsonContent));
    }

    /**
     * @Route("/addComJson/{id}", name="add_commentaireJson")
     */
    public function addComJson(Request $request,NormalizerInterface $Normalizer,$id): Response
    {


        $pub = $this->getDoctrine()
            ->getRepository(Publication::class)
            ->findPostByid($id);

        $com=new Commentaire();
        $com->setCreated(new \DateTime());
        $com->setPub($pub);
        $com->setContenuCom($request->get('contenu_com'));

        $em=$this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();

        $jsonContent = $Normalizer->normalize($com, 'json', ['groups'=>'post:read']);
        return new Response("comment added successfully".json_encode($jsonContent));

    }

}
