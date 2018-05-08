<?php

namespace App\Controller\Admin;

use App\Entity\Schedule;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class ScheduleController extends Controller
{
    /**
     * @Route("/schedule/add", name="add_schedule_by_admin_action")
     * @Method("POST")
     */
    public function addScheduleAction(Request $request)
    {
        $request->setRequestFormat('json');

        $title = $request->get('title');
        $text = $request->get('text');

        if ($title == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $schedule = new Schedule();

        $schedule->setText($text);
        $schedule->setTitle($title);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($schedule);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/schedule", name="schedule_delete_from_table_action")
     * @Method("DELETE")
     */
    public function scheduleDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $schedule = $entityManager->getRepository(Schedule::class)->find($id);
        $entityManager->remove($schedule);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/schedule", name="schedule_edit_from_table_action")
     * @Method("POST")
     */
    public function scheduleEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $schedule = $entityManager->getRepository(Schedule::class)->find($id);

        $title = $request->get('title');
        $text = $request->get('text');

        if ($text == null || $title == null) {
            throw new Exception("Введены неверные данные");
        }

        $schedule->setTitle($title);
        $schedule->setText($text);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
