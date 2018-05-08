<?php

namespace App\Controller\Admin;

use App\Entity\DocumentForRegistration;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class DocumentForRegistrationController extends Controller
{
    /**
     * @Route("/document-for-registration/add", name="add_document_for_registration_by_admin_action")
     * @Method("POST")
     */
    public function addDocumentForRegistrationAction(Request $request)
    {
        $request->setRequestFormat('json');

        $text = $request->get('text');

        if ($text == null) {
            throw new Exception("Введены неверные данные");
        }

        $documentForRegistration = new DocumentForRegistration();

        $documentForRegistration->setText($text);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($documentForRegistration);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/document-for-registration", name="document_for_registration_delete_from_table_action")
     * @Method("DELETE")
     */
    public function documentForRegistrationDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $documentForRegistration = $entityManager->getRepository(DocumentForRegistration::class)->find($id);
        $entityManager->remove($documentForRegistration);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/document-for-registration", name="document_for_registration_edit_from_table_action")
     * @Method("POST")
     */
    public function documentForRegistrationEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $documentForRegistration = $entityManager->getRepository(DocumentForRegistration::class)->find($id);

        $text = $request->get('text');

        if ($text == null) {
            throw new Exception("Введены неверные данные");
        }

        $documentForRegistration->setText($text);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
