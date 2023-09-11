<?php
/**
 * Contact controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController.
 */
#[Route('/contact', name: 'contact')]
class ContactController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'contact', methods: 'GET')]
    public function index(Request $request): Response
    {
        return $this->render('contact/index.html.twig');
    }
}
