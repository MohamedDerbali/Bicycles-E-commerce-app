<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your product name must be at least {{ limit }} characters long",
     *      maxMessage = "Your product name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 6,
     *      minMessage = "Your model name must be at least {{ limit }} characters long",
     *      maxMessage = "Your model name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 6,
     *      minMessage = "Your type name must be at least {{ limit }} characters long",
     *      maxMessage = "Your type name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    /**
     * @var string
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/jpg", "application/png"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;
    /**
     * @var string
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/avi", "application/mp4"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @ORM\Column(name="tutorial", type="string", length=255)
     */
    private $tutorial;
    /**
     * @var float
     * @Assert\GreaterThan(
     *     value = 100
     * )
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;
    /**
     *@ORM\ManyToOne(targetEntity="Categorie")
     *@ORM\JoinColumn(referencedColumnName="id")
     */
private $Categorie;
    /**
     * @var string
     * @Assert\Length(
     *      min = 20,
     *      max = 30,
     *      minMessage = "Your description  must be at least {{ limit }} characters long",
     *      maxMessage = "Your description  cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="description", type="string", length=1500)
     */
private $description;
    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $qte;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Produit
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Produit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getTutorial()
    {
        return $this->tutorial;
    }

    /**
     * @param string $tutorial
     */
    public function setTutorial($tutorial)
    {
        $this->tutorial = $tutorial;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }

    /**
     * @param mixed $Categorie
     */
    public function setCategorie($Categorie)
    {
        $this->Categorie = $Categorie;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param int $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }

}

