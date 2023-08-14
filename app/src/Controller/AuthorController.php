<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class TaskController.
 */
#[Route('/author')]
class AuthorController extends AbstractController
{
    /**
     * Index action.
     *
     * @param AuthorRepository $authorRepository Author repository
     *
     * @return Response HTTP response
     */
    #[Route(
        name: 'author_index',
        methods: 'GET'
    )]
    public function index(Request $request, AuthorRepository $authorRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $authorRepository->queryAll(),
            $request->query->getInt('page', 1),
            AuthorRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('author/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Author $author Author entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'author_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET',
    )]
    public function show(Author $author): Response
    {
        return $this->render(
            'author/show.html.twig',
            ['author' => $author]
        );
    }
}