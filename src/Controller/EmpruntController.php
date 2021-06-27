<?php

namespace App\Controller;
use App\Entity\DVD;
use App\Entity\Facture;
use App\Form\EmprunteType;
use App\Form\EmpruntUserType;
use App\Entity\Emprunt;
use App\Form\EmpruntType;
use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emprunt")
 */
class EmpruntController extends AbstractController
{
    /**
     * @Route("/", name="emprunt_index", methods={"GET"})
     */
    public function index(Request $request)
    {
    $em = $this->getDoctrine()->getManager();

$emprunts=  $this->getDoctrine()->getRepository(Emprunt::class)->findAll();

      return $this->render('emprunt/index.html.twig', array(
            'emprunts' => $emprunts,
        ));
    }
      /**
     * @Route("/listeemprunt", name="emprunteclient_index", methods={"GET"})
     */
      public function indexemprunt(Request $request)
    {
        //$this->denyAccessUnlessGranted('ROLE_ETUDIANT');
          $em = $this->getDoctrine()->getManager();

                $user = $this->getUser();









$emprunts=  $this->getDoctrine()->getRepository(Emprunt::class)->findByUser($user->getId());


             return $this->render('emprunt/index.html.twig', array(
            'emprunts' => $emprunts,
        ));



}
   /**
     * @Route("/newemprunt", name="emprunte_new", methods={"GET","POST"})
     */
    public function newemprunt(Request $request): Response
    {
        $emprunt = new Emprunt();
        $form = $this->createForm(EmpruntUserType::class, $emprunt);
        $form->handleRequest($request);
                $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $id=$request->query->get('id');
                $user = $this->getUser();

$userid =$user->getId();

        $dvd=$em->getRepository(DVD::class)->find($id);
                $nbr=$em->getRepository(Emprunt::class)->findbyNbredvdemprunte($id);
$nbrcopie=$dvd->getNbrcopie();
$disponibilite=$nbrcopie-$nbr;

               $emprunt->setDVD($dvd);
$emprunt->setUser($user);

if($disponibilite==1)

{
            $dvd=$em->getRepository(DVD::class)->find($id);

               $dvd->setEtat('Non disponible');


}



$emprunt->setEtat('Encours');
$em->persist($emprunt);



 $em->flush();



$this->addFlash(
            'success',
            'Ajout se fait avec succès '
        );

            return $this->redirectToRoute('emprunteclient_index');
        }

        return $this->render('emprunt/new.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/new", name="emprunt_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $emprunt = new Emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);
                $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $id=$request->query->get('id');


        $dvd=$em->getRepository(DVD::class)->find($id);
                $nbr=$em->getRepository(Emprunt::class)->findbyNbredvdemprunte($id);
$nbrcopie=$dvd->getNbrcopie();
$disponibilite=$nbrcopie-$nbr;

               $emprunt->setDVD($dvd);


if($disponibilite==1)

{
            $dvd=$em->getRepository(DVD::class)->find($id);

               $dvd->setEtat('Non disponible');


}



$emprunt->setEtat('Encours');
$em->persist($emprunt);



 $em->flush();



$this->addFlash(
            'success',
            'Ajout se fait avec succès '
        );

            return $this->redirectToRoute('emprunt_index');
        }

        return $this->render('emprunt/new.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprunt_show", methods={"GET"})
     */
    public function show(Emprunt $emprunt): Response
    {
        return $this->render('emprunt/show.html.twig', [
            'emprunt' => $emprunt,
        ]);
    }
  /**
     * @Route("/{id}/editclient", name="empruntclient_edit", methods={"GET","POST"})
     */
    public function editclient(Request $request, Emprunt $emprunt): Response
    {
        $form = $this->createForm(EmprunteType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

              $daterendu = $form["daterendu"]->getData();
//$dated = $form["datedebut"]->getData()->format("Y-m-d");
        $datef = $form["datefin"]->getData()->format("Y-m-d");
        $dater = $form["daterendu"]->getData()->format("Y-m-d");
$datefin = strtotime($datef);
$daterenduu= strtotime($dater);
$nbJoursTimestamp =$daterenduu - $datefin;
//$iduser=$request->query->get('id');
                $user = $this->getUser();
$nbJours = $nbJoursTimestamp/86400;
//var_dump($nbJours);
//exit();
$id=$form["dvd"]->getData();
//var_dump($id);
//exit();
$em=$this->getDoctrine()->getManager();

            $DVDe=$em->getRepository(DVD::class)->find($id->getid());

           $DVDe->setEtat('disponible');



$emprunt->setEtat('Retour');
  //$daterendu=new \Datetime($dater);
               $emprunt->setDaterendu($daterendu);
$bareme="15";
if($nbJours>0)
{
if( ($nbJours<$bareme)){
            $DVDe=$em->getRepository(DVD::class)->find($id->getid());
           // $idemp=$request->query->get('id');

//$emprunte=$em->getRepository(Emprunt::class)->find($emprunt->getId());
$prix=$DVDe->getPrix();
$prixajout=$prix+200;
//var_dump($emprunte);
//exit();
               $emprunt->setPrix($prixajout);



 $em->persist($emprunt);
            $em->flush();
}
    else
           {
       //$facture=new Facture();
            $DVDe=$em->getRepository(DVD::class)->find($id->getid());
           // $idemp=$request->query->get('id');

//$emprunte=$em->getRepository(Emprunt::class)->find($emprunt->getId());
$prix=$DVDe->getPrix();
$prixajout=$prix+400;
//var_dump($emprunte);
//exit();
               $emprunt->setPrix($prixajout);
                             // $facture->setEmprunt($emprunte);

 $em->persist($emprunt);
            $em->flush();
           }
            }   //$emprunt->setUser($user);
            $DVDe=$em->getRepository(DVD::class)->find($id->getid());
              $prix=$DVDe->getPrix();
               $emprunt->setPrix($prix);
  $user = $this->getUser();
    $entityManager = $this->getDoctrine()->getManager();

          $facture = new Facture();
                     $facture->setEmprunt($emprunt);

            $reference = $entityManager->getRepository(Facture::class)->getReferenceOfLastfacture();

       if ($reference == null) {
            $result = date('Y') . '1';
        } else {

          //  $newReference = intval(substr($reference, strpos($reference, '/') + 1)) + 1;
            $result = date('Y'). $reference+1;
        }

        $facture->setReference($result);
         // $this->generatereference($facture);
          $facture->setEditeur($user);
          //$facture->setReference('111');
         // $facture->setClient($client);
           $entityManager->persist($facture);
            $entityManager->flush();
$em->persist($emprunt);
 $em->flush();
 $this->addFlash(
            'success',
            'Retour DVD se fait avec succès '
        );
            return $this->redirectToRoute('emprunteclient_index');
        }

        return $this->render('emprunt/edit.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="emprunt_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Emprunt $emprunt): Response
    {
        $form = $this->createForm(EmprunteType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

              $daterendu = $form["daterendu"]->getData();
//$dated = $form["datedebut"]->getData()->format("Y-m-d");
        $datef = $form["datefin"]->getData()->format("Y-m-d");
        $dater = $form["daterendu"]->getData()->format("Y-m-d");
$datefin = strtotime($datef);
$daterenduu= strtotime($dater);
$nbJoursTimestamp =$daterenduu - $datefin;

$nbJours = $nbJoursTimestamp/86400;
//var_dump($nbJours);
//exit();
$id=$form["dvd"]->getData();
//var_dump($id);
//exit();
$em=$this->getDoctrine()->getManager();

            $DVDe=$em->getRepository(DVD::class)->find($id->getid());

           $DVDe->setEtat('disponible');



$emprunt->setEtat('Retour');
  //$daterendu=new \Datetime($dater);
               $emprunt->setDaterendu($daterendu);
$bareme="15";
if($nbJours<$bareme){
$DVDe=$em->getRepository(DVD::class)->find($id->getid());
$prix=$DVDe->getPrix();
$prixajout=$prix+200;
//var_dump($prixajout);
//exit();
               $DVDe->setPrixemprunte($prixajout);
 $em->persist($DVDe);
            $em->flush();
}
    else
           {
  $DVDe=$em->getRepository(DVD::class)->find($id->getid());
               $prix=$DVDe->getPrixemprunte();
$prixajout=$prix+400;
//var_dump($prixajout);
//exit();
               $DVDe->setPrix($prixajout);
 $em->persist($DVDe);
            $em->flush();
           }

$em->persist($emprunt);
 $em->flush();
 $this->addFlash(
            'success',
            'Retour DVD se fait avec succès '
        );
            return $this->redirectToRoute('emprunt_index');
        }

        return $this->render('emprunt/edit.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/emprunt_delete/{id}", name="emprunt_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Emprunt $emprunt): Response
    {
        //if ($this->isCsrfTokenValid('delete'.$emprunt->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emprunt);
            $entityManager->flush();
        //}
$this->addFlash(
            'success',
            'Suppression se fait avec succès '
        );
        return $this->redirectToRoute('emprunt_index');
    }
}
