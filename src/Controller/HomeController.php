<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
		$msg = "Wesh ceci est la page d'accueil gros";

        return $this->render('home/index.html.twig', [
			'msg' => $msg,
			'portif' => $portif,
        ]);
    }
}
