<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// pour tous les controleurs, je fais un extends de la classe AbstractController
class HomeController extends AbstractController
{

	/**
	 * @Route("/test3", name="home_index")
	 */
	public function index(Request $request)
	{

		if ($request->query->get('age') > 18) {
			return new Response('bonjour');
		} else {
			return new Response('Au revoir');
		}

	}

	/**
	 * @Route("/blog/{id}", name="blog")
	 */
	public function blog($id)
	{
		return new Response($id);
	}

	/**
	 * @Route("/contact", name="contact")
	 */
	public function contact()
	{
		// j'imagine qu'un formulaire a été submit
		// par le client

		// et ensuite je redirige vers une autre page (idéalement
		// une page qui affiche un message de confirmation)
		return $this->redirectToRoute('home_index');
	}

	/**
	 * @Route("/twig", name="twig")
	 */
	public function twigBasic()
	{
		// réponse http valide
		// qui appelle un fichier twig
		// et affiche son contenu (HTML)
		return $this->render("basic.html.twig");
	}

}