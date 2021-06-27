<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
   $user->setRoles (array('ROLE_USER'));

            $entityManager = $this->getDoctrine()->getManager();
              $username=$user->getUsername();

            $username_exist=$entityManager->getRepository(User::class)->findByusername($username);
           //ar_dump($username_exist);
            //it();
            $email=$user->getEmail();
             $email_exist=$entityManager->getRepository(User::class)->findByemail($email);


if($username_exist)
            {
                   $this->addFlash(
            'error',
            'nom Utilisateur existe '
        );
                return $this->redirectToRoute('user_registration');
            }
            if($email_exist)
            {
                    $this->addFlash(
            'error',
            'Email existe '
        );

                return $this->redirectToRoute('user_registration');
            }
            else
            {
            $this->addFlash(
            'success',
            'Enregistrement se fait avec succès '
        );
            return $this->redirectToRoute('default');
        }
        $entityManager->persist($user);
            $entityManager->flush();
}

        return $this->render('user/new.html.twig',
            array('form' => $form->createView())
        );
    }
 /**
     * @Route("/registeradmin", name="user_registrationadmin")
     */
    public function registeradmin(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

   $user->setRoles (array('ROLE_ADMIN'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
            'success',
            'Ajout se fait avec succès '
        );
            return $this->redirectToRoute('default');
        }

        return $this->render('user/new.html.twig',
            array('form' => $form->createView())
        );
    }
  /**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request)

    {
        $user = $this->getUser();

return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/editprofil", name="editprofil")
     */
    public function editprofil(Request $request)

    {
        $user = $this->getUser();
   $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/editprofil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
     /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
