<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/admin/login", name="security_admin_login")
     */
    public function index()
    {
        $helper = $this->get('security.authentication_utils');
        return $this->render('security/index.html.twig', [
            // last username entered by the user (if any)
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }
}
