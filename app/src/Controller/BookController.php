<?php
/**
 * Book controller.
 */

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\BookType;
use App\Service\BookService;
use App\Service\BookServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookController.
 */
#[Route('/book')]
class BookController extends AbstractController
{
    /**
     * Book service.
     */
    private BookServiceInterface $bookService;

    /**
     * Constructor.
     */
    public function __construct(BookServiceInterface $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'book_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->bookService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('book/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Book $book Book
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'book_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', ['book' => $book]);
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     */
    #[Route(
        '/create',
        name: 'book_create',
        methods: 'GET|POST',
    )]
    public function create(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookService->save($book);

            return $this->redirectToRoute('book_index');
        }

        return $this->render(
            'book/create.html.twig',
            ['form' => $form->createView()]
        );
    }
}
