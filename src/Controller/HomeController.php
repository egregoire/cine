<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

use Tmdb\ApiToken;
use Tmdb\Client;

require dirname(__DIR__).'/../config/bootstrap.php';
require_once dirname(__DIR__).'/../vendor/autoload.php';

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $router = $this->container->get('router');

        $token  = new ApiToken('f1209ad4c7c658a1b2b5b8a7ae135500');
        $client = new Client($token);
        $repository = new \Tmdb\Repository\MovieRepository($client);
        //$topRated = $repository->getTopRated(array('page' => 3));
        $movie = $repository->getPopular(
            [
                'language' => 'FR',
                'page' => 2
            ]
        );

        //print_r($movie);
        //echo json_encode($movie);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'movies' => $movie

        ]);
    }
}
