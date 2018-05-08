<?php

namespace App\Controller\Admin;

use App\Entity\DateOfMedical;
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
class DateOfMedicalController extends Controller
{
    /**
     * @Route("/dates-of-medical/add", name="add_date_of_medical_by_admin_action")
     * @Method("POST")
     */
    public function addDateOfMedicalAction(Request $request)
    {
        $request->setRequestFormat('json');

        $date = new DateTime($request->get('date'));
        $text = $request->get('text');

        if ($date == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $dateOfMedical = new DateOfMedical();

        $dateOfMedical->setDate($date);
        $dateOfMedical->setText($text);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($dateOfMedical);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dates-of-medical/", name="date_of_medical_delete_from_table_action")
     * @Method("DELETE")
     */
    public function dateOfMedicalDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $dateOfMedical = $entityManager->getRepository(DateOfMedical::class)->find($id);
        $entityManager->remove($dateOfMedical);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dates-of-medical/", name="date_of_medical_edit_from_table_action")
     * @Method("POST")
     */
    public function dateOfMedicalEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $dateOfMedical = $entityManager->getRepository(DateOfMedical::class)->find($id);

        $date = new DateTime($request->get('date'));
        $text = $request->get('text');

        if ($date == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $dateOfMedical->setDate($date);
        $dateOfMedical->setText($text);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
