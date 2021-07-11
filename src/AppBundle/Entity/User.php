<?php

	// src/AppBundle/Entity/User.php

	namespace AppBundle\Entity;

	use FOS\UserBundle\Model\User as BaseUser;
	use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="fos_user")
	 */
	class User extends BaseUser
	{
    	    /**
    	     * @ORM\Id
    	     * @ORM\Column(type="integer")
    	     * @ORM\GeneratedValue(strategy="AUTO")
    	     */
	    protected $id;

        /**
         * @var string
         *  @Assert\Length(min = 8, max = 8, minMessage = "min_lenght", maxMessage = "max_lenght")
         * @Assert\Regex(pattern="/^[0-9]*$/", message="number_only")
         * @ORM\Column(name="Cin", type="string", length=255)
         */
        private $Cin;


        /**
         * @var string
         *
         * @ORM\Column(name="Nom", type="string", length=255)
         */
        private $nom;

        /**
         * @var string
         *
         * @ORM\Column(name="Prenom", type="string", length=255)
         */
        private $Prenom;


        /**
         * @var char
         *
         * @ORM\Column(name="Sexe", type="string", length=255)
         */
        private $Sexe;

        /**
         * @var \Date
         *
         * @ORM\Column(name="Date_naissance", type="date")
         */
        private $Date_naissance;


        /**
         * @var string
         *  @Assert\Length(min = 8, max = 8, minMessage = "min_lenght", maxMessage = "max_lenght")
         * @Assert\Regex(pattern="/^[0-9]*$/", message="number_only")
         * @ORM\Column(name="Num_tel", type="string", length=255)
         */
        private $Num_tel;

        /**
         * @var string
         *
         * @ORM\Column(name="Adresse", type="string", length=255)
         */
        private $Adresse;

        /**
         * @var string
         *
         * @ORM\Column(name="Poste", type="string", length=255)
         */
        private $Poste;

        /**
         * @var string
         *
         * @ORM\Column(name="Civilite", type="string", length=255)
         */
        private $Civilite;

        /**
         * @var string
         *
         * @ORM\Column(name="Pays", type="string", length=255)
         */
        private $Pays;

        /**
         * @var string
         *
         * @ORM\Column(name="Ville", type="string", length=255)
         */
        private $Ville;

        /**
         * @var string
         *  @Assert\Length(min = 4, max = 4, minMessage = "min_lenght", maxMessage = "max_lenght")
         * @Assert\Regex(pattern="/^[0-9]*$/", message="number_only")
         * @ORM\Column(name="Code_postal", type="string")
         */
        private $Code_postal;
        /**
         * @var string
         *
         * @ORM\Column(name="photo", type="string", length=255)
         */
        private $photo;

        public function __construct()
	    {
        	        parent::__construct();
	        // your own logic
	    }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->Cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->Cin;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->Prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->Sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->Sexe;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->Date_naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->Date_naissance;
    }

    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return User
     */
    public function setNumTel($numTel)
    {
        $this->Num_tel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->Num_tel;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->Adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->Adresse;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return User
     */
    public function setPoste($poste)
    {
        $this->Poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->Poste;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return User
     */
    public function setCivilite($civilite)
    {
        $this->Civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->Civilite;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return User
     */
    public function setPays($pays)
    {
        $this->Pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->Pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->Ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->Ville;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return User
     */
    public function setCodePostal($codePostal)
    {
        $this->Code_postal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->Code_postal;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

}
