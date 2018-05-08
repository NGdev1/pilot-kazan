<?php

namespace App\Controller\Admin;

use App\Entity\DateOfExam;
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
class DateOfExamController extends Controller
{
    /**
     * @Route("/dates-of-exam/add", name="add_date_of_exam_by_admin_action")
     * @Method("POST")
     */
    public function addDateOfExamAction(Request $request)
    {
        $request->setRequestFormat('json');

        $date = new DateTime($request->get('date'));
        $text = $request->get('text');

        if ($date == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $dateOfExam = new DateOfExam();

        $dateOfExam->setDate($date);
        $dateOfExam->setText($text);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($dateOfExam);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dates-of-exam/", name="date_of_exam_delete_from_table_action")
     * @Method("DELETE")
     */
    public function dateOfExamDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $dateOfExam = $entityManager->getRepository(DateOfExam::class)->find($id);
        $entityManager->remove($dateOfExam);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dates-of-exam/", name="date_of_exam_edit_from_table_action")
     * @Method("POST")
     */
    public function dateOfExamEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $dateOfExam = $entityManager->getRepository(DateOfExam::class)->find($id);

        $date = new DateTime($request->get('date'));
        $text = $request->get('text');

        if ($date == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $dateOfExam->setDate($date);
        $dateOfExam->setText($text);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
