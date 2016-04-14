<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACYG\GsbFraisBundle\Entity\Visiteur ;
use Symfony\Component\HttpFoundation\Session\Session;

class ConnexionController extends Controller {
    public function indexAction() {
        $session = new Session() ;
        
        $form = $this->createFormBuilder()
                ->add('login', 'text')
                ->add('motDePasse', 'password')
                ->add('Valider', 'submit')
                ->add('Annuler', 'reset')
                ->getForm() ;
        
        $request = $this->container->get('request') ;
        $form->handleRequest($request) ;
        $message = 0 ;
        
        if($session->get('visiteur') != null) {
            return $this->redirectToRoute("acyg_gsb_frais_vueVisiteur") ;
        }
        
        if($session->get('comptable') != null) {
            return $this->redirectToRoute("acyg_gsb_frais_vueComptable") ;
        }
        
        if ($form->isValid()) {
            $formData = $form->getData() ;
            $login = $formData['login'] ;
            $mdp = $formData['motDePasse'] ;
            
            $repository_visiteur = $this->getDoctrine()
                                   ->getManager()
                                   ->getRepository('ACYGGsbFraisBundle:Visiteur') ;
            
            $repository_comptable = $this->getDoctrine()
                                   ->getManager()
                                   ->getRepository('ACYGGsbFraisBundle:Comptable') ;
        
            $visiteur = $repository_visiteur->findOneBy(array('login'=>$login, 'mdp'=>$mdp)) ;
            $comptable = $repository_comptable->findOneBy(array('login'=>$login, 'mdp'=>$mdp)) ;
            
            if($visiteur != null) {
                $session->start() ;
                $session->set('visiteur', $visiteur);
                
                return $this->redirectToRoute("acyg_gsb_frais_vueVisiteur") ;
            }
            elseif($comptable != null) {
                $session->start() ;
                $session->set('comptable', $comptable);
                
                return $this->redirectToRoute("acyg_gsb_frais_vueComptable") ;
            }
            else {
                $message = 1 ;
            }
        }
        
        return $this->render('ACYGGsbFraisBundle:Connexion:vueConnexion.html.twig', 
                array('form'=>$form->createView(), 'message'=>$message)) ;
    }
    
    public function deconnexionAction() {
        $session = $this->getRequest()->getSession() ;
        $session->invalidate() ;
        
        return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
    }
    
}
