<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $user = $this->getUser();

        if ($user) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('AppBundle:default:login.html.twig');
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function dashboardAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('AppBundle:default:dashboard.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('AppBundle:default:create.html.twig', [
            'user' => $user
        ]);
    }
}
