<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Emprunt;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DefaultController extends AbstractController
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
     * @Route("/", name="default")
     */
    public function index(Request $request)
    {
     $this->denyAccessUnlessGranted('ROLE_USER');
                   $em = $this->getDoctrine()->getManager();
  //  $nbrproduits=sizeof($products);
        $year=date('Y');


        $tabdvd=array();
        $tabdvdd=array();

    for ( $i=1 ; $i<13 ;$i++){
      $k=$i;
      if($i<10){
      $k='0'.$i;
      }
      $yearmois=$year.'-'.$k;


      $nbredvd=$em->getRepository(Emprunt::class)->findbyNbredvdEmprunteMois($yearmois);
            array_push($tabdvd , $nbredvd);
            $user = $this->security->getUser(); // null or UserInterface, if logged in


//$iduser = $em->getRepository(User::class)->findby(array('id'=>$user->getId()));
//var_dump($iduser);$iduser =
//exit();
$userid =$user->getId();
//var_dump($userid);
//exit();
  $nbredvdd=$em->getRepository(Emprunt::class)->findbyNbredvdEmprunteMoiss($userid,$yearmois);
  //var_dump($nbr);
//exit();
        array_push($tabdvdd , $nbredvdd);

      }
        return $this->render('default/index.html.twig', array(
'tabdvd'=>$tabdvd,
'tabdvdd'=>$tabdvdd,





));
    }
}
