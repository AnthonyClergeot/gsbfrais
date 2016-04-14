<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACYG\GsbFraisBundle\Entity\Visiteur ;
use Symfony\Component\HttpFoundation\Session\Session;

class SuivrePaiementController extends Controller {
    public function indexAction() {
        $session = $this->getRequest()->getSession() ;
        
        if($session->get('comptable') != null) {
            return $this->render('ACYGGsbFraisBundle:Comptable:vueSuivrePaiement.html.twig') ;
        }
        else {
            return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
        }
    }
}