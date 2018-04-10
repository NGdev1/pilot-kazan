<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    private function siteRenderFullView($parameters)
    {
        return $this->render('site/index.html.twig', $parameters);
    }

    /**
     * @Route("/", name="site_index")
     */
    public function showMainPageAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/main.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'main'
            ]);
        }
    }

    /**
     * @Route("/for-students", name="site_for_students")
     */
    public function showForStudentsAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/for_students.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'for-students'
            ]);
        }
    }

}
