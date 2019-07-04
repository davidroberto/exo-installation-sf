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

}