<?php
/**
 * Publisher controller.
 */

namespace App\Controller;

use App\Entity\Publisher;
use App\Service\PublisherService;
use App\Form\Type\PublisherType;
use App\Service\PublisherServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class PublisherController.
 */
#[Route('/publisher')]
class PublisherController extends AbstractController
{
    /**
     * Publisher service.
     */
    private PublisherServiceInterface $publisherService;

    /**
     * Translator.
     *
     * @var TranslatorInterface
     */
    private TranslatorInterface $translator;
    /**
     * Constructor.
     * @param PublisherServiceInterface $publisherService Publisher service
     * @param TranslatorInterface      $translator  Translator
     */
    public function __construct(PublisherServiceInterface $publisherService, TranslatorInterface $translator)
    {
        $this->publisherService = $publisherService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'publisher_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->publisherService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('publisher/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Publisher $publisher Publisher
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'publisher_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Publisher $publisher): Response
    {
        return $this->render('publisher/show.html.twig', ['publisher' => $publisher]);
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
        name: 'publisher_create',
        methods: 'GET|POST',
    )]
    public function create(Request $request): Response
    {
        $publisher = new Publisher();
        $form = $this->createForm(PublisherType::class, $publisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->publisherService->save($publisher);

            $this->addFlash(
                'success',
                $this->translator->trans('message.added_success')
            );

            return $this->redirectToRoute('publisher_index');
        }

        return $this->render(
            'publisher/create.html.twig',
            ['form' => $form->createView()]
        );
    }

}
