<?php

namespace ACYG\GsbFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraisforfait
 *
 * @ORM\Table(name="LigneFraisForfait", indexes={@ORM\Index(name="FK_LigneFraisForfait_id_FraisForfait", columns={"id_FraisForfait"}), @ORM\Index(name="FK_LigneFraisForfait_id_FicheFrais", columns={"id_FicheFrais"})})
 * @ORM\Entity
 */
class Lignefraisforfait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var \Fichefrais
     *
     * @ORM\ManyToOne(targetEntity="Fichefrais", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_FicheFrais", referencedColumnName="id")
     * })
     */
    private $idFichefrais;

    /**
     * @var \Fraisforfait
     *
     * @ORM\ManyToOne(targetEntity="Fraisforfait")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_FraisForfait", referencedColumnName="id")
     * })
     */
    private $idFraisforfait;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set idFichefrais
     *
     * @param \ACYG\GsbFraisBundle\Entity\Fichefrais $idFichefrais
     * @return Lignefraisforfait
     */
    public function setIdFichefrais(\ACYG\GsbFraisBundle\Entity\Fichefrais $idFichefrais = null)
    {
        $this->idFichefrais = $idFichefrais;

        return $this;
    }

    /**
     * Get idFichefrais
     *
     * @return \ACYG\GsbFraisBundle\Entity\Fichefrais 
     */
    public function getIdFichefrais()
    {
        return $this->idFichefrais;
    }

    /**
     * Set idFraisforfait
     *
     * @param \ACYG\GsbFraisBundle\Entity\Fraisforfait $idFraisforfait
     * @return Lignefraisforfait
     */
    public function setIdFraisforfait(\ACYG\GsbFraisBundle\Entity\Fraisforfait $idFraisforfait = null)
    {
        $this->idFraisforfait = $idFraisforfait;

        return $this;
    }

    /**
     * Get idFraisforfait
     *
     * @return \ACYG\GsbFraisBundle\Entity\Fraisforfait 
     */
    public function getIdFraisforfait()
    {
        return $this->idFraisforfait;
    }
}
