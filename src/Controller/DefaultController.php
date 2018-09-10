<?php

namespace App\Controller;

use App\Entity\DateOfAdmission;
use App\Entity\DateOfExam;
use App\Entity\DateOfMedical;
use App\Entity\DocumentForRegistration;
use App\Entity\Promotion;
use App\Entity\Schedule;
use App\Entity\UserApplication;
use App\Form\UserApplicationType;
use DateTime;
use Exception;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Finder\Finder;

class DefaultController extends Controller
{
    private function siteRenderFullView($parameters)
    {
        return $this->render('site/index.html.twig', $parameters);
    }

    /**
     * @Route("/user-applications/add", name="add_user_application_action")
     * @Method("POST")
     */
    public function addUserApplicationAction(Request $request)
    {
        $request->setRequestFormat('json');

        $userApplication = new UserApplication();

        $form = $this->createForm(UserApplicationType::class, $userApplication);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new Exception("Введены неверные данные");
        }

        $userApplication->setDateOfApplication(new DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userApplication);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }


    /**
     * @Route("/", name="site_index")
     */
    public function showMainPageAction(Request $request)
    {
        $datesOfAdmission = $this->getDoctrine()->getRepository(DateOfAdmission::class)->findAll();
        $promotion = $this->getDoctrine()->getRepository(Promotion::class)->findAll();
        $form = $this->createForm(
            UserApplicationType::class, null,
            array(
                'action' => $this->generateUrl('add_user_application_action'),
            )
        );

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/main.html.twig',
                [
                    'datesOfAdmission' => $datesOfAdmission,
                    'promotion' => $promotion,
                    'form' => $form->createView()
                ]
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'main',
                'datesOfAdmission' => $datesOfAdmission,
                'promotion' => $promotion,
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/events", name="site_events")
     */
    public function showEventsAction(Request $request)
    {
        $schedule = $this->getDoctrine()->getRepository(Schedule::class)->findAll();
        $datesOfMedical = $this->getDoctrine()->getRepository(DateOfMedical::class)->findAll();
        $datesOfExam = $this->getDoctrine()->getRepository(DateOfExam::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/events.html.twig',
                [
                    'schedule' => $schedule,
                    'datesOfMedical' => $datesOfMedical,
                    'datesOfExam' => $datesOfExam
                ]
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'events',
                'schedule' => $schedule,
                'datesOfMedical' => $datesOfMedical,
                'datesOfExam' => $datesOfExam
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
        $docmentsForRegistration = $this->getDoctrine()->getRepository(DocumentForRegistration::class)->findAll();
        $form = $this->createForm(
            UserApplicationType::class, null,
            array(
                'action' => $this->generateUrl('add_user_application_action'),
            )
        );

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/enroll.html.twig',
                [
                    'documentsForRegistration' => $docmentsForRegistration,
                    'form' => $form->createView()
                ]
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'enroll',
                'documentsForRegistration' => $docmentsForRegistration,
                'form' => $form->createView()
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
        $finder = new Finder();
        $files = $finder->in($this->get('kernel')->getProjectDir() . '/public/Пилот документы');

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'site/info.html.twig', [
                    'files' => $files
                ]
            );
        } else {
            return $this->siteRenderFullView([
                'content' => 'info',
                'files' => $files
            ]);
        }
    }

}
