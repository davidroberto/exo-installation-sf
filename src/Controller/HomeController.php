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


	/**
	 * @Route("/list", name="list")
	 *
	 * créé une page pour utiliser la fonction path et la fonction link
	 */
	public function list()
	{

		$articles = [
			1 => [
				'title' => 'Article 1',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://gal.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2Fprismamedia_people.2F2017.2F07.2F03.2Fcd76a89a-9f7f-44fc-a066-06bbb34281af.2Ejpeg/2216x1536/quality/80/charles-pasqua.jpeg'
			],
			2 => [
				'title' => 'Article 2',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'http://s1.lprs1.fr/images/2018/05/15/7716630_a7834498-5761-11e8-aba9-269965d92401-1_940x500.jpg'
			],
			3 => [
				'title' => 'Article 3',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://tel.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2FTEL.2Enews.2F2018.2F01.2F12.2F28453de3-9265-4ba8-9b3d-1dae3e693d03.2Ejpeg/1150x495/crop-from/top/une-nouvelle-emission-pour-jamy-gourmaud.jpg'
			],
			4 => [
				'title' => 'Article 4',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://static.cnews.fr/sites/default/files/styles/image_640_360/public/jean-lassalle_0.jpg?itok=kzxd2dc3'
			],
			5 => [
				'title' => 'Article 5',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://www.lamanchelibre.fr/photos/maxi/649833.jpg'
			],
			6 => [
				'title' => 'Article 6',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://img.cdandlp.com/2016/10/imgL/118348804.jpg'
			],

		];


		return $this->render("articleList.html.twig" , [
			'articles' => $articles
		]);


	}

	/**
	 * @Route("/single/{id}", name="single_article")
	 */
	public function single($id)
	{

		$articles = [
			1 => [
				'title' => 'Article 1',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://gal.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2Fprismamedia_people.2F2017.2F07.2F03.2Fcd76a89a-9f7f-44fc-a066-06bbb34281af.2Ejpeg/2216x1536/quality/80/charles-pasqua.jpeg'
			],
			2 => [
				'title' => 'Article 2',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'http://s1.lprs1.fr/images/2018/05/15/7716630_a7834498-5761-11e8-aba9-269965d92401-1_940x500.jpg'
			],
			3 => [
				'title' => 'Article 3',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://tel.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2FTEL.2Enews.2F2018.2F01.2F12.2F28453de3-9265-4ba8-9b3d-1dae3e693d03.2Ejpeg/1150x495/crop-from/top/une-nouvelle-emission-pour-jamy-gourmaud.jpg'
			],
			4 => [
				'title' => 'Article 4',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://static.cnews.fr/sites/default/files/styles/image_640_360/public/jean-lassalle_0.jpg?itok=kzxd2dc3'
			],
			5 => [
				'title' => 'Article 5',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://www.lamanchelibre.fr/photos/maxi/649833.jpg'
			],
			6 => [
				'title' => 'Article 6',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://img.cdandlp.com/2016/10/imgL/118348804.jpg'
			],

		];


		$products = [
			[
				'title' => 'Trotinette 1',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 1
			],
			[
				'title' => 'Trotinette 2',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 2
			],
			[
				'title' => 'Trotinette 3',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 3
			],
			[
				'title' => 'Trotinette 4',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 4
			],
			[
				'title' => 'Trotinette 5',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 5
			],
			[
				'title' => 'Trotinette 6',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 6
			],
			[
				'title' => 'Trotinette 7',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 7
			],
			[
				'title' => 'Trotinette 8',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum explicabo fuga ipsa nostrum officiis placeat quas quisquam ullam unde vitae. Blanditiis dolore enim perspiciatis quos rerum similique sint ut? Laboriosam.',
				'image' => 'https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/324168.jpg',
				'id' => 8
			],

		];

		return $this->render('article_show.html.twig', [
			'article' => $articles[$id]
		]);

	}


}