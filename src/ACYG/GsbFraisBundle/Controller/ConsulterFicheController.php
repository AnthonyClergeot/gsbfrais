<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACYG\GsbFraisBundle\Entity\Visiteur ;
use ACYG\GsbFraisBundle\Entity\Fichefrais ;
use ACYG\GsbFraisBundle\Entity\Lignefraisforfait ;
use ACYG\GsbFraisBundle\Entity\Lignefraishorsforfait ;
use Symfony\Component\HttpFoundation\Session\Session;

class ConsulterFicheController extends Controller {
    public function indexAction() {
        $session = $this->getRequest()->getSession() ;
        $message = null ;
        
        if($session->get('visiteur') != null) {
            $form = $this->createFormBuilder()
                ->add('date', 'date',  array(
                        'format' => 'ddMMyyyy',
                        'years' => range(date('Y'), date('Y')-10)
                        ))
                ->add('Valider', 'submit')
                ->getForm() ;
        
            $request = $this->container->get('request') ;
            $form->handleRequest($request) ;
            
            $date = null ;
            $ficheFrais = null ;
            $lignesFraisForfait = null ;

            if ($form->isValid()) {
                $formData = $form->getData() ;
                $date = $formData['date'] ;
                
                $repository_visiteur = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Visiteur') ;
                $visiteur = $repository_visiteur->findOneBy(array('id' => $session->get('visiteur'))) ;

                $repository_fichefrais = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Fichefrais') ;
                $repository_lignefraisforfait = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Lignefraisforfait') ;
                $repository_lignefraishorsforfait = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Lignefraishorsforfait') ;
                
                $month = $date->format('m') ;
                
                $ficheFrais = $repository_fichefrais->findBY(array('idVisiteur'=>$visiteur, 'mois'=>$month)) ;
                $lignesFraisForfait = $repository_lignefraisforfait->findBy(
                        array('idFichefrais'=>$ficheFrais)) ;
                
                return $this->render('ACYGGsbFraisBundle:Visiteur:vueConsulterFiche.html.twig',
                    array('message'=>$message, 'form'=>$form->createView(), 'ficheFrais'=>$ficheFrais,
                        'date'=>$date, 'lignesFraisForfait'=>$lignesFraisForfait)) ;
            }
            
            return $this->render('ACYGGsbFraisBundle:Visiteur:vueConsulterFiche.html.twig',
                    array('message'=>$message, 'form'=>$form->createView(), 'ficheFrais'=>$ficheFrais,
                        'date'=>$date)) ;
        }
        else {
                return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
            }
    }
}