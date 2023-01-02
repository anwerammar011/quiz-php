<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Quiz;
use App\Entity\Questions;


class SecurityController extends AbstractController


{
    /**
     * @Route("/home", name="home")
     */
    public function home(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('home.html.twig');
    }
  

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    /**
     * @Route("/logout", name="app_logout")
     * 
     */
    public function logout(AuthenticationUtils $authenticationUtils): Response
    { 
        return $this->redirectToRoute('home');
    }
    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('user/test.html.twig');
    }
}
