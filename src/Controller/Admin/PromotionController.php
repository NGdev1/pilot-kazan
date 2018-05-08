<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class PromotionController extends Controller
{
    /**
     * @Route("/promotion/add", name="add_promotion_by_admin_action")
     * @Method("POST")
     */
    public function addPromotionAction(Request $request)
    {
        $request->setRequestFormat('json');
        
        $text = $request->get('text');
        $type = $request->get('type');

        if ($type == null || $text == null) {
            throw new Exception("Введены неверные данные");
        }

        $promotion = new Promotion();

        $promotion->setText($text);
        $promotion->setType($type);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($promotion);
        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/promotion", name="promotion_delete_from_table_action")
     * @Method("DELETE")
     */
    public function promotionDeleteAction(Request $request)
    {
        $request->setRequestFormat('json');

        $id = $request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $promotion = $entityManager->getRepository(Promotion::class)->find($id);
        $entityManager->remove($promotion);

        $entityManager->flush();
        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }

    /**
     * @Route("/promotion", name="promotion_edit_from_table_action")
     * @Method("POST")
     */
    public function promotionEditFromTableAction(Request $request)
    {
        $request->setRequestFormat('json');

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $promotion = $entityManager->getRepository(Promotion::class)->find($id);

        $text = $request->get('text');

        if ($text == null) {
            throw new Exception("Введены неверные данные");
        }

        $promotion->setText($text);

        $entityManager->flush();

        $result = array(
            'status' => 'ok',//ok | error
        );

        return new Response(json_encode($result));
    }
}
