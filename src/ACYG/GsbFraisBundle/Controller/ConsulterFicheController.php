<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACYG\GsbFraisBundle\Entity\Visiteur ;
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

                $repository_fichefrais = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Fichefrais') ;
                $repository_lignefraisforfait = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Lignefraisforfait') ;
                $repository_lignefraishorsforfait = $this->getDoctrine()
                                       ->getManager()
                                       ->getRepository('ACYGGsbFraisBundle:Lignefraishorsforfait') ;

                $lignesFraisForfait = $repository_lignefraisforfait->findOneBy(
                        array('idvisiteur'=>'a117', 'mois'=>'3', 'idfraisforfait'=>'REP')) ;
                $ficheFrais = $repository_fichefrais->findAll() ;
                
                return $this->render('ACYGGsbFraisBundle:Visiteur:vueConsulterFiche.html.twig',
                    array('message'=>$message, 'form'=>$form->createView(), 'ficheFrais'=>$ficheFrais,
                        'date'=>$date)) ;
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