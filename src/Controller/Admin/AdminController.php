<?php

namespace App\Controller\Admin;

use App\Entity\DateOfAdmission;
use App\Entity\DateOfExam;
use App\Entity\DateOfMedical;
use App\Entity\DocumentForRegistration;
use App\Entity\Promotion;
use App\Entity\Schedule;
use App\Entity\UserApplication;
use App\Form\UserApplicationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/boards/user-applications", name="boards_user_applications")
     * @Method("GET")
     */
    public function showUserApplicationsAction(Request $request)
    {
        $userApplications = $this->getDoctrine()->getRepository(UserApplication::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/user_applications.html.twig',
                [
                    'userApplications' => $userApplications,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/user-applications/add", name="boards_user_application_add")
     * @Method("GET")
     */
    public function showUserApplicationAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $form = $this->createForm(
                UserApplicationType::class,
                null,
                array(
                    'action' => $this->generateUrl('add_user_application_by_admin_action'),
                )
            );

            return $this->render(
                'admin/boards/add_user_application.html.twig',
                [
                    'form' => $form->createView(),
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/site-edit", name="boards_site_edit")
     * @Method("GET")
     */
    public function siteEditAction()
    {
        return $this->index();
    }

    /**
     * @Route("/boards/dates-of-admission", name="boards_dates_of_admission")
     * @Method("GET")
     */
    public function showDatesOfAdmissionAction(Request $request)
    {
        $datesOfAdmission = $this->getDoctrine()->getRepository(DateOfAdmission::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/dates_of_admission.html.twig',
                [
                    'datesOfAdmission' => $datesOfAdmission,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/dates-of-admission/add", name="boards_date_of_admission_add")
     * @Method("GET")
     */
    public function showDateOfAdmissionAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/add_date_of_admission.html.twig'
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/dates-of-medical", name="boards_dates_of_medical")
     * @Method("GET")
     */
    public function showDatesOfMedicalAction(Request $request)
    {
        $datesOfMedical = $this->getDoctrine()->getRepository(DateOfMedical::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/dates_of_medical.html.twig',
                [
                    'datesOfMedical' => $datesOfMedical,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/dates-of-medical/add", name="boards_date_of_medical_add")
     * @Method("GET")
     */
    public function showDateOfMedicalAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/add_date_of_medical.html.twig'
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/dates-of-exam", name="boards_dates_of_exam")
     * @Method("GET")
     */
    public function showDatesOfExamAction(Request $request)
    {
        $datesOfExam = $this->getDoctrine()->getRepository(DateOfExam::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/dates_of_exam.html.twig',
                [
                    'datesOfExam' => $datesOfExam,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/dates-of-exam/add", name="boards_date_of_exam_add")
     * @Method("GET")
     */
    public function showDateOfExamAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/add_date_of_exam.html.twig'
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/documents-for-registration", name="boards_documents_for_registration")
     * @Method("GET")
     */
    public function showDocumentsForRegistrationAction(Request $request)
    {
        $docmentsForRegistration = $this->getDoctrine()->getRepository(DocumentForRegistration::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/documents_for_registration.html.twig',
                [
                    'documentsForRegistration' => $docmentsForRegistration,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/documents-for-registration/add", name="boards_document_for_registration_add")
     * @Method("GET")
     */
    public function showDocumentForRegistrationAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/add_document_for_registration.html.twig'
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/schedule", name="boards_schedule")
     * @Method("GET")
     */
    public function showScheduleAction(Request $request)
    {
        $schedule = $this->getDoctrine()->getRepository(Schedule::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/schedule.html.twig',
                [
                    'schedule' => $schedule,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/schedule/add", name="boards_document_for_registration_add")
     * @Method("GET")
     */
    public function showSheduleAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/add_schedule.html.twig'
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/promotion", name="boards_promotion")
     * @Method("GET")
     */
    public function showPromotionAction(Request $request)
    {
        $promotion = $this->getDoctrine()->getRepository(Promotion::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/promotion.html.twig',
                [
                    'promotion' => $promotion,
                ]
            );
        } else {
            return $this->index();
        }
    }

    /**
     * @Route("/boards/promotion/add", name="boards_promotion_add")
     * @Method("GET")
     */
    public function showPromotionAddBoardAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'admin/boards/add_promotion.html.twig'
            );
        } else {
            return $this->index();
        }
    }
}
