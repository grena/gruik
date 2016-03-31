<?php

namespace Gruik\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author  grena <hello@grena.fr>
 * @license https://opensource.org/licenses/GPL-3.0  GNU General Public License v3.0 (GPL-3.0)
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return new Response('Gruik!');
    }
}
