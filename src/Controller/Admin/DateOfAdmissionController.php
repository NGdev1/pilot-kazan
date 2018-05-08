<?php

namespace App\Controller\Admin;

use App\Entity\DateOfAdmission;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class DateOfAdmissionController extends Controller
{
    /**
     * @Route("/dates-of-admission/add", name="add_date_of_admission_by_admin_action")
     * @Method("POST")
     */
    public function addDateOfAdmissionAction(Request $request)
    {
        $request->setRequestFormat('json');

        $date = new DateTime($request->get('date'));
        $text = $request->get('text');

        if ($date == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $dateOfAdmission = new DateOfAdmission();

        $dateOfAdmission->setDate($date);
        $dateOfAdmission->setText($text);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($dateOfAdmission);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dates-of-admission/", name="date_of_admission_delete_from_table_action")
     * @Method("DELETE")
     */
    public function dateOfAdmissionDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $dateOfAdmission = $entityManager->getRepository(DateOfAdmission::class)->find($id);
        $entityManager->remove($dateOfAdmission);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dates-of-admission/", name="date_of_admission_edit_from_table_action")
     * @Method("POST")
     */
    public function dateOfAdmissionEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $dateOfAdmission = $entityManager->getRepository(DateOfAdmission::class)->find($id);

        $date = new DateTime($request->get('date'));
        $text = $request->get('text');

        if ($date == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $dateOfAdmission->setDate($date);
        $dateOfAdmission->setText($text);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
