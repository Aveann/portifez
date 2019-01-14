<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Form\UserForm;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
		$error = "";
		
        $user = new User();
        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);
		
        if ($form->isSubmitted() && $form->isValid()) {
			
			
			
            $entityManager = $this->getDoctrine()->getManager();
			
			//vérifier si un utilisaeur avec cet email existe déjà
			$userCheck = $entityManager->getRepository(User::class)->findOneBy(['email' => $form['email']->getData()]);
			
			
			//s'il n'existe pas, on enregistre l'utilisateur
			if(!$userCheck){
				$password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());

				$user->setPassword($password);
				
				$entityManager->persist($user);
				$entityManager->flush();
			
				//rediriger à la page précédente
				return $this->redirectToRoute('login');
				
			} else {
				$error = "Un utilisateur avec cet email existe déjà.";
			}
        }
			
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
			'error' => $error
        ]);
    }
}
