<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prefere
 *
 * @ORM\Table(name="prefere")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\PrefereRepository")
 */
class Prefere
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $clientpref;


    /**
     * @ORM\ManyToOne(targetEntity="\ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $prodpref;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getClientpref()
    {
        return $this->clientpref;
    }

    /**
     * @param mixed $clientpref
     */
    public function setClientpref($clientpref)
    {
        $this->clientpref = $clientpref;
    }

    /**
     * @return mixed
     */
    public function getProdpref()
    {
        return $this->prodpref;
    }

    /**
     * @param mixed $prodpref
     */
    public function setProdpref($prodpref)
    {
        $this->prodpref = $prodpref;
    }



}

