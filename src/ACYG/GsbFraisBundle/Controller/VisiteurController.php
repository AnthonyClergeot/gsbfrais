<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VisiteurController extends Controller {
    public function indexAction() {
        $session = $this->getRequest()->getSession() ;
        
        if($session->get('visiteur') != null) {
            return $this->render('ACYGGsbFraisBundle:Visiteur:vueVisiteur.html.twig') ;
        }
        else {
            return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
        }
    }
}
