<?php
namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACYG\GsbFraisBundle\Entity\Visiteur ;
use Symfony\Component\HttpFoundation\Session\Session;
use ACYG\GsbFraisBundle\Entity\Fichefrais ;
use ACYG\GsbFraisBundle\Entity\Lignefraisforfait ;
use ACYG\GsbFraisBundle\Entity\Lignefraishorsforfait ;
use ACYG\GsbFraisBundle\Entity\Fraisforfait ;
//use Symfony\Component\Validator\Constraints\Date ;
//use Symfony\Component\Validator\Constraints\DateTime ;

class RenseignerFicheController extends Controller {
    public function indexAction() {
        $session = $this->getRequest()->getSession() ;
        
        if($session->get('visiteur') != null) {
            $form = $this->createFormBuilder()
                    ->add('mois', 'integer')
                    ->add('annee', 'integer')
                    ->add('repasMidi', 'integer')
                    ->add('nuitees', 'integer')
                    ->add('etape', 'integer')
                    ->add('km', 'integer')
                    ->add('date', 'date',  array(
                        'format' => 'ddMMyyyy',
                        'required' => false
                        ))
                    ->add('libelle', 'text', array(
                        'required' => false))
                    ->add('montant', 'money', array(
                        'required' => false))
                    ->add('nbJustificatif', 'integer')
                    ->add('montantTotal', 'money')
                    ->add('Valider', 'submit')
                    ->add('Annuler', 'reset')
                    ->getForm() ;

            $request = $this->container->get('request') ;
            $form->handleRequest($request) ;
            $message = null ;
            
            $dateNow = new \DateTime("now") ;
            
            if ($form->isValid()) {
                $formData = $form->getData() ;
                $mois = $formData['mois'] ;
                $annee = $formData['annee'] ;
                $repasMidi = $formData['repasMidi'] ;
                $nuitees = $formData['nuitees'] ;
                $etape = $formData['etape'] ;
                $km = $formData['km'] ;
                $date = $formData['date'] ;
                $libelle = $formData['libelle'] ;
                $montant = $formData['montant'] ;
                $nbJustificatif = $formData['nbJustificatif'] ;
                $montantTotal = $formData['montantTotal'] ;
                
                $visiteur = $session->get('visiteur') ;
                $repository_visiteur = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('ACYGGsbFraisBundle:Visiteur') ;
                $unVisiteur = $repository_visiteur->find($visiteur) ;
                
                $repository_etats = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('ACYGGsbFraisBundle:Etat') ;
                $etat = $repository_etats->findOneBy(array('id' => "CR")) ;
                
                $repository_frais = $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('ACYGGsbFraisBundle:Fraisforfait') ;
                $fraisRepas = $repository_frais->findOneBy(array('id' => "REP")) ;
                $fraisNuitee = $repository_frais->findOneBy(array('id' => "NUI")) ;
                $fraisEtape = $repository_frais->findOneBy(array('id' => "ETP")) ;
                $fraisKm = $repository_frais->findOneBy(array('id' => "KM")) ;
                
                $fiche = new Fichefrais() ;
                $fiche->setMois($mois) ;
                $fiche->setAnnee($annee) ;
                $fiche->setNbjustificatifs($nbJustificatif) ;
                $fiche->setMontantvalide($montantTotal) ;
                $fiche->setIdEtat($etat) ;
                $fiche->setDatemodif($dateNow) ;
                $fiche->setIdVisiteur($unVisiteur) ;
                
                $ligneForfaitRepas = new Lignefraisforfait() ;
                $ligneForfaitRepas->setIdFichefrais($fiche) ;
                $ligneForfaitRepas->setIdFraisforfait($fraisRepas) ;
                $ligneForfaitRepas->setQuantite($repasMidi) ;
                
                $ligneForfaitNuit = new Lignefraisforfait() ;
                $ligneForfaitNuit->setIdFichefrais($fiche) ;
                $ligneForfaitNuit->setIdFraisforfait($fraisNuitee) ;
                $ligneForfaitNuit->setQuantite($nuitees) ;
                
                $ligneForfaitEtape = new Lignefraisforfait() ;
                $ligneForfaitEtape->setIdFichefrais($fiche) ;
                $ligneForfaitEtape->setIdFraisforfait($fraisEtape) ;
                $ligneForfaitEtape->setQuantite($etape) ;
                
                $ligneForfaitKm = new Lignefraisforfait() ;
                $ligneForfaitKm->setIdFichefrais($fiche) ;
                $ligneForfaitKm->setIdFraisforfait($fraisKm) ;
                $ligneForfaitKm->setQuantite($km) ;
                
                if($libelle != null || $montant != null) {
                    $ligneHorsForfait = new Lignefraishorsforfait() ;
                    $ligneHorsForfait->setDate($date) ;
                    $ligneHorsForfait->setLibelle($libelle) ;
                    $ligneHorsForfait->setMontant($montant) ;
                    $ligneHorsForfait->setIdFichefrais($fiche) ;
                }
                
                $em = $this->getDoctrine()->getManager() ;
                $em->persist($fiche) ;
                $em->persist($ligneForfaitRepas) ;
                $em->persist($ligneForfaitNuit) ;
                $em->persist($ligneForfaitEtape) ;
                $em->persist($ligneForfaitKm) ;
                if($libelle != null || $montant != null) {
                    $em->persist($ligneHorsForfait) ;
                }
                $em->flush() ;
                
                return $this->render('ACYGGsbFraisBundle:Visiteur:vueVisiteur.html.twig',
                        array('form'=>$form->createView(), 'message'=>$message)) ;
            }

            return $this->render('ACYGGsbFraisBundle:Visiteur:vueRenseignerFiche.html.twig',
                        array('form'=>$form->createView(), 'message'=>$message)) ;
        }
        
        else {
                return $this->redirectToRoute("acyg_gsb_frais_vueConnexion") ;
        }
    }
}
