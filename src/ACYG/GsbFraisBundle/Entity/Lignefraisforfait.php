<?php

namespace ACYG\GsbFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraisforfait
 *
 * @ORM\Table(name="LigneFraisForfait")
 * @ORM\Entity
 */
class Lignefraisforfait
{
  

      /**
     * @var \Visiteur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Fichefrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVisiteur", referencedColumnName="idVisiteur")
     * })
     */
    private $idvisiteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="mois", type="integer", length=6, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Fichefrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mois", referencedColumnName="mois")
     * })
     */
    private $mois;

    
    /**
     * @var \FraisForfait
     * 
     * @ORM\ManyToOne(targetEntity="Fraisforfait", inversedBy="id")
     * @ORM\JoinColumn(name="idFraisForfait")
     */
    private $idfraisforfait;


    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * Set mois
     *
     * @param integer $mois
     * @return Lignefraisforfait
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return integer 
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Lignefraisforfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idfraisforfait = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Lignefraisforfait
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set idvisiteur
     *
     * @param \ACYG\GsbFraisBundle\Entity\Fichefrais $idvisiteur
     * @return Lignefraisforfait
     */
    public function setIdvisiteur(\ACYG\GsbFraisBundle\Entity\Fichefrais $idvisiteur)
    {
        $this->idvisiteur = $idvisiteur;

        return $this;
    }

    /**
     * Get idvisiteur
     *
     * @return \ACYG\GsbFraisBundle\Entity\Fichefrais 
     */
    public function getIdvisiteur()
    {
        return $this->idvisiteur;
    }

    /**
     * Add idfraisforfait
     *
     * @param \ACYG\GsbFraisBundle\Entity\Fraisforfait $idfraisforfait
     * @return Lignefraisforfait
     */
    public function addIdfraisforfait(\ACYG\GsbFraisBundle\Entity\Fraisforfait $idfraisforfait)
    {
        $this->idfraisforfait[] = $idfraisforfait;

        return $this;
    }

    /**
     * Remove idfraisforfait
     *
     * @param \ACYG\GsbFraisBundle\Entity\Fraisforfait $idfraisforfait
     */
    public function removeIdfraisforfait(\ACYG\GsbFraisBundle\Entity\Fraisforfait $idfraisforfait)
    {
        $this->idfraisforfait->removeElement($idfraisforfait);
    }

    /**
     * Get idfraisforfait
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdfraisforfait()
    {
        return $this->idfraisforfait;
    }

    /**
     * Set idfraisforfait
     *
     * @param \ACYG\GsbFraisBundle\Entity\Fraisforfait $idfraisforfait
     * @return Lignefraisforfait
     */
    public function setIdfraisforfait(\ACYG\GsbFraisBundle\Entity\Fraisforfait $idfraisforfait = null)
    {
        $this->idfraisforfait = $idfraisforfait;

        return $this;
    }
}
