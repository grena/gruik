<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @return Response
     */
    public function loginAction()
    {
        $user = $this->getUser();

        if ($user) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('AppBundle:default:login.html.twig');
    }

    /**
     * @return Response
     */
    public function dashboardAction()
    {
        $user = $this->getUser();

        return $this->render('AppBundle:default:dashboard.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @return Response
     */
    public function createAction()
    {
        $user = $this->getUser();

        return $this->render('AppBundle:default:create.html.twig', [
            'user' => $user
        ]);
    }
}
