<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACYG\GsbFraisBundle\Entity\Visiteur ;
use Symfony\Component\HttpFoundation\Session\Session;

class RenseignerFicheController extends Controller {
    public function indexAction() {
        $session = $this->getRequest()->getSession() ;
        
        $form = $this->createFormBuilder()
                ->add('mois', 'integer')
                ->add('annee', 'integer')
                ->add('repasMidi', 'integer')
                ->add('nuitees', 'integer')
                ->add('etape', 'integer')
                ->add('km', 'integer')
                ->add('date', 'date',  array(
                                        'format' => 'ddMMyyyy'
                                        ))
                ->add('libelle', 'integer')
                ->add('montant', 'money')
                ->add('nbJustificatif', 'integer')
                ->add('montantTotal', 'money')
                ->add('Valider', 'submit')
                ->add('Annuler', 'reset')
                ->getForm() ;
        
        $request = $this->container->get('request') ;
        $form->handleRequest($request) ;
        $message = 0 ;
        
        if($session->get('visiteur') != null) {
            return $this->render('ACYGGsbFraisBundle:Visiteur:vueRenseignerFiche.html.twig',
                    array('form'=>$form->createView(), 'message'=>$message)) ;
        }
        else {
            return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
        }
        
        if ($form->isValid()) {
            
        }
        
        return $this->render('ACYGGsbFraisBundle:Visiteur:vueRenseignerFiche.html.twig',
                    array('form'=>$form->createView(), 'message'=>$message)) ;
    }
}
