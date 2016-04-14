<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComptableController extends Controller {
    public function indexAction() {
        $session = $this->getRequest()->getSession() ;
        
        if($session->get('comptable') != null) {
            return $this->render('ACYGGsbFraisBundle:Comptable:vueComptable.html.twig') ;
        }
        else {
            return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
        }
    }
}
