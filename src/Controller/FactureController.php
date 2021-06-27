<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/facture")
 */
class FactureController extends AbstractController
{

	 /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

 /**
     * @Route("/listefacture", name="listefacture_index", methods={"GET"})
     */
    public function listefacture(Request $request)
    {
    $em = $this->getDoctrine()->getManager();

$factures=  $this->getDoctrine()->getRepository(Facture::class)->findAll();

      return $this->render('facture/index.html.twig', array(
            'factures' => $factures,
        ));
    }
    /**
     * @Route("/", name="facture_index", methods={"GET"})
     */
    public function index(FactureRepository $factureRepository): Response
    {
       //$this->denyAccessUnlessGranted('ROLE_ETUDIANT');
          $em = $this->getDoctrine()->getManager();

                $user = $this->getUser();


$factures=  $this->getDoctrine()->getRepository(Facture::class)->findByUser($user->getId());

        return $this->render('facture/index.html.twig', array(
            'factures' => $factures,
        ));
    }


    /**
     * @Route("/new", name="facture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
	$entityManager = $this->getDoctrine()->getManager();
		//$idclient=$request->request->get('idclientclient');

 //$client=$entityManager->getRepository('App\Entity\Client')-> find($idclient);


                $user = $this->getUser();

		  $facture = new Facture();

		    $reference = $entityManager->getRepository(Facture::class)->getReferenceOfLastfacture();

       if ($reference == null) {
            $result = date('Y') . '1';
        } else {

          //  $newReference = intval(substr($reference, strpos($reference, '/') + 1)) + 1;
            $result = date('Y'). $reference+1;
        }

		$facture->setReference($result);
         // $this->generatereference($facture);
		  $facture->setEditeur($editeur);
		  //$facture->setReference('111');
		 // $facture->setClient($client);
		   $entityManager->persist($facture);
            $entityManager->flush();


			   return $this->redirectToRoute('emprunt_index');

      /*  $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facture);
            $entityManager->flush();

            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
		*/
    }

    /**
     * @Route("/facture_show/{id}", name="facture_show", methods={"GET"})
     */
    public function show(Facture $facture): Response
    {
		//if( $facture->getIsopen()==true ){
		//	$em = $this->getDoctrine()->getManager();
			//$facture->setIsopen(false);
		 // $em->persist($facture);
		 // $em->flush();
		//}
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="facture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Facture $facture): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
$this->addFlash(
            'success',
            'Modification se fait avec succès '
        );
            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/facture_delete/{id}", name="facture_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Facture $facture): Response
    {

      //  if (count($facture->gettransactions())>0){
				//$this->addFlash('error', 'vous devez supprimer les transactions ' );
		//}
		//else{

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($facture);
            $entityManager->flush();
            $this->addFlash(
            'success',
            'Suppression se fait avec succès '
        );
		//}


        return $this->redirectToRoute('facture_index');
    }





}
