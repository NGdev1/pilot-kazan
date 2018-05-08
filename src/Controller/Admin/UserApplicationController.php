<?php

namespace App\Controller\Admin;

use App\Entity\UserApplication;
use App\Form\UserApplicationType;
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
class UserApplicationController extends Controller
{
    /**
     * @Route("/user-applications/add", name="add_user_application_by_admin_action")
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
     * @Route("/user-applications/", name="user_applications_delete_from_table_action")
     * @Method("DELETE")
     */
    public function userApplicationDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $userApplication = $entityManager->getRepository(UserApplication::class)->find($id);
        $entityManager->remove($userApplication);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/user-applications/", name="user_applications_edit_from_table_action")
     * @Method("POST")
     */
    public function userApplicationsEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $userApplication = $entityManager->getRepository(UserApplication::class)->find($id);

        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $dateOfApplication = new DateTime($request->get('dateOfApplication'));
        $info = $request->get('info');

        if ($name == null || $email == null || $phone == null) {
            throw new Exception("Введены неверные данные");
        }

        $userApplication->setName($name);
        $userApplication->setEmail($email);
        $userApplication->setPhone($phone);
        $userApplication->setInfo($info);
        $userApplication->setDateOfApplication($dateOfApplication);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
