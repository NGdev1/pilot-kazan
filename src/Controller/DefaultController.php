<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="site_index")
     */
    public function index()
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
