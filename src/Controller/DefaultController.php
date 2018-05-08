<?php

namespace App\Controller;

use App\Entity\DateOfAdmission;
use App\Entity\Promotion;
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
        $datesOfAdmission = $this->getDoctrine()->getRepository(DateOfAdmission::class)->findAll();
        $promotion = $this->getDoctrine()->getRepository(Promotion::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/main.html.twig',
                [
                    'datesOfAdmission' => $datesOfAdmission,
                    'promotion' => $promotion
                ]
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'main',
                'datesOfAdmission' => $datesOfAdmission,
                'promotion' => $promotion,
            ]);
        }
    }

    /**
     * @Route("/events", name="site_events")
     */
    public function showEventsAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/events.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'events'
            ]);
        }
    }

    /**
     * @Route("/theory-and-practice", name="site_theory_and_practice")
     */
    public function showTheotyAndPracticeAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/theory_and_practice.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'theory-and-practice'
            ]);
        }
    }

    /**
     * @Route("/resources", name="site_resources_for_students")
     */
    public function showResourcesAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/resources_for_students.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'resources'
            ]);
        }
    }

    /**
     * @Route("/enroll", name="site_enroll")
     */
    public function showEnrollAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/enroll.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'enroll'
            ]);
        }
    }

    /**
     * @Route("/about", name="site_about")
     */
    public function showAboutAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/about.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'about'
            ]);
        }
    }

    /**
     * @Route("/info", name="site_info")
     */
    public function showInfoAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/info.html.twig'
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'info'
            ]);
        }
    }

}
