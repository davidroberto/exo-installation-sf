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

	/**
	 * @Route("/article_show", name="article_show")
	 */
	public function articleShow()
	{
		// on simule une requête en base de données
		// pour récupérer un article
		// on enregistre le titre de l'article dans une variable
		$article = "je suis un article";

		// on appelle un fichier twig avec en premier
		// parametre le nom du fichier twig
		return $this->render("article.html.twig",
			// et en second parametre un tableau
			// qui contient les variables à envoyer au fichier Twig
			// (les variables envoyées au fichier Twig
			// pourront être appelées dans le fichier Twig
			[
				'variableArticleTwig' => $article
			]
		);

	}

	/**
	 * @Route("/conditiontwig", name="condition_twig")
	 */
	public function conditionTwig()
	{

		// je déclare des variables
		$age = 50;
		$display = true;

		// j'appelle un fichier Twig (qui sera compilé en html et renvoyé en réponse)
		// et je lui passe des variables (que je pourrai exploiter dans le fichier Twig)
		return $this->render('condition_twig.html.twig',
			[
				'age' => $age,
				'display' => $display
			]
		);
	}


	/**
	 *  @Route("/articlelist", name="article_list")
	 *
	 * Je créé une méthode avec en parametre la classe Request (pour pouvoir récupérer toutes les infos
	 * liées à la requete, dont les parametres get
	 */
	public function articlesList(Request $request)
	{
		// je récupère le parametre get "age", c'est à dire la valeur de la variable d'url "age"
		// je stocke la valeur de l'age dans une variable
		$age = $request->query->get('age');

		// je créé un array multidimensionnel, qui contient 4 articles
		// avec pour chacun un titre, un contenu et une image
		$articles = [
			[
				'titre' => 'titre 1',
				'contenu' => 'contenu test 1',
				'image' => 'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-1029171697.jpg'
			],
			[
				'titre' => 'titre 2',
				'contenu' => 'contenu test 2',
				'image' => 'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-1029171697.jpg'
			],
			[
				'titre' => 'titre 3',
				'contenu' => 'contenu test 3',
				'image' => 'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-1029171697.jpg'
			],
			[
				'titre' => 'titre 4',
				'contenu' => 'contenu test 4',
				'image' => 'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-1029171697.jpg'
			]
		];

		// je retourne une réponse grâce à la méthode render, qui prend en premier parametre un fichier twig
		// et en second un tableau contenant toutes les variables à envoyer au fichier twig
		// et que donc je pourrai utiliser dans le fichier twig
		return $this->render('articleList.html.twig',
			[
				'age' => $age,
				'articles' => $articles
			]
		);
	}




}