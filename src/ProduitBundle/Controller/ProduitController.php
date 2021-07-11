<?php

namespace ProduitBundle\Controller;

use Knp\Component\Pager\Pagination\PaginationInterface;
use ProduitBundle\Entity\Categorie;
use ProduitBundle\Entity\CommentaireProd;
use ProduitBundle\Entity\Prefere;
use ProduitBundle\Entity\Produit;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * Produit controller.
 *
 * @Route("prod")
 */
class ProduitController extends Controller
{

    public function liveSearchAction(Request $request)
    {
        $requestString = $request->get('q');
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('ProduitBundle:Produit')->search($requestString);
     /*$serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($produits);*/
        if(!$produits) {
            $result['entities']['error'] = "xD";
        } else {
            $result['entities'] = $this->getRealEntities($produits);
        }

        return new Response(json_encode($result));

    }
    public function getRealEntities($entities){

        foreach ($entities as $entity){
            $realEntities[$entity->getNom()] = $entity->getNom();
            $realEntities[$entity->getModele()] = $entity->getModele();
            $realEntities[$entity->getType()] = $entity->getType();
            $realEntities[$entity->getPrix()] = $entity->getPrix();
            $realEntities[$entity->getPhoto()] = $entity->getPhoto();
            $realEntities[$entity->getTutorial()] = $entity->getTutorial();
        }

        return $realEntities;
    }
    /**
     * Lists all produit entities.
     *
     * @Route("/", name="prod_index")
     * @Method("GET")
     */

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();


        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $produits,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('produit/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }
    public function chartPieAction(Request $request)
    {
        $pieChart = new ColumnChart();
        $em= $this->getDoctrine();
        $Asso = $em->getRepository(Categorie::class)->findAll();
        $data= array();
        $stat=['Les Catégories', 'Nombre des Produits Per Catégorie'];
        array_push($data,$stat);
        foreach ($Asso as $b){
            $x=$em->getRepository(Produit::class)->findFF($b->getId());
            //   var_dump($x);
            $stat=array();
            foreach ($x as $i) {
                foreach ($i as $o) {
                    $p = $o + 0;

                    array_push($stat, $b->getNom(), $p);//$classe->get());
                    $stat = [$b->getNom(), $p];
                    array_push($data, $stat);

                }
            }
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Nombre Produit / Categorie');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Produit\Default\stat.html.twig', array('piechart' => $pieChart));

    }
    /**
     * Creates a new produit entity.
     *
     * @Route("/new", name="prod_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('ProduitBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('photo')->getData();
            $videoFile=$form->get('tutorial')->getData();
            if ($brochureFile && $videoFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFilenamevideo = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $safeFilenamevideo = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilenamevideo);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                $newFilenamevideo = $safeFilenamevideo.'-'.uniqid().'.'.$videoFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                    $videoFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilenamevideo
                    );
                } catch (FileException $e) {
                }
                $produit->setPhoto($newFilename);
                $produit->setTutorial($newFilenamevideo);

            }
           $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
}

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     * @Route("/{id}", name="prod_show")
     * @Method("GET")
     */
    public function showAction(Request $request,$id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        //   echo $tit;

        $userId=$user->getId();

        $userimg=$user->getPhoto();
        $j=$em->getRepository('ProduitBundle:Produit')->find($id);

        $C=$em->getRepository('ProduitBundle:CommentaireProd')->fiii($id);


        if ($request->isMethod('POST')) {
            $comm = $request->get('comment');
            $rate = $request->get('rating');

            $date = new \DateTime();

            $cm=new CommentaireProd();
            $cm->setComment($comm);
            $cm->setRate($rate);
            $cm->setProduit($j);
            $cm->setUserid($user);
            $cm->setDate($date);
            $em = $this->getDoctrine()->getManager();


            $em->persist($cm);


            $em->flush();
            $C=$em->getRepository('ProduitBundle:CommentaireProd')->fiii($id);

        }

        return $this->render('produit/show.html.twig', array(
            'produit' => $j,
            'com'=>$C,
            'usrid'=>$userId,
            'img'=>$userimg,

        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     * @Route("/{id}/edit", name="prod_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('ProduitBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prod_edit', array('id' => $produit->getId()));
        }

        return $this->render('produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/{id}", name="prod_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('prod_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prod_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function favAction($id)
    { if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id_usr = $user->getId();
        var_dump($id);
        $id+=0;
        $em=$this->getDoctrine()->getManager();
        var_dump($id);
        $B=$em->getRepository('ProduitBundle:Produit')->find($id) ;
        //$x=(int)$id;
        $pref = new Prefere();
        $pref->setProdpref($B);
        $pref->setClientpref($user);

        $em->persist($pref);
        $em->flush();

    }
        return $this->redirectToRoute('prod_index');
    }
    public function remComAction($id,$prodid)
    {   $em=$this->getDoctrine()->getManager();
        //echo $id;
        $B=$em->getRepository('ProduitBundle:CommentaireProd')->find($id) ;
        $em->remove($B);
        $em ->flush();

        return $this->redirectToRoute('prod_show',array('id'=>$prodid));

    }
}
