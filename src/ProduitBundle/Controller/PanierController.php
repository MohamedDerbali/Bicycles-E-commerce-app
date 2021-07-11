<?php

namespace ProduitBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use ProduitBundle\Entity\Produit;

class PanierController extends Controller
{    public function removePanierAction(SessionInterface $session,$id)
{
    $panier =$session->get('panier',[]);
if(!empty($panier[$id])){
    unset($panier[$id]);

}
$session->set('panier',$panier);

return $this->redirectToRoute("panier");
}

    public function indexAction(SessionInterface $session)
    {
        $em=$this->getDoctrine();

        $panier=$session->get('panier',[]);


        $panierWithData=[];

        foreach($panier as $id =>$qte){

            $panierWithData[]=[
                'produit' => $em->getRepository('ProduitBundle:Produit')->find($id),
                'qte' => $qte
            ];
         }

        $total =0;

        foreach($panierWithData as $item){
            $totalItem=$item['produit']->getPrix()* $item['qte'];
            var_dump($totalItem);
            $total+=$totalItem;
        }

        return $this->render('produit/cart.html.twig',array('items' => $panierWithData, 'total' => $total));
}


    public function addPanierAction(SessionInterface $session,$id){



       $panier= $session->get('panier',[]);

    if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);

     return $this->redirectToRoute('panier');
    }




}
