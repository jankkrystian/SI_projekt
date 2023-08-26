<?php
/**
 * Creator controller.
 */

namespace App\Controller;

use App\Entity\Creator;
use App\Form\Type\CreatorType;
use App\Service\CreatorServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class CreatorController.
 */
#[Route('/creator')]
class CreatorController extends AbstractController
{
    /**
     * Creator service.
     */
    private CreatorServiceInterface $creatorService;

    /**
     * Translator.
     *
     * @var TranslatorInterface
     */
    private TranslatorInterface $translator;
    /**
     * Constructor.
     * @param CreatorServiceInterface $creatorService Creator service
     * @param TranslatorInterface      $translator  Translator
     */

    /**
     * Constructor.
     */
    public function __construct(CreatorServiceInterface $taskService, TranslatorInterface $translator)
    {
        $this->creatorService = $taskService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'creator_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->creatorService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('creator/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Creator $creator Creator
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'creator_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Creator $creator): Response
    {
        return $this->render('creator/show.html.twig', ['creator' => $creator]);
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
        name: 'creator_create',
        methods: 'GET|POST',
    )]
    public function create(Request $request): Response
    {
        $creator = new Creator();
        $form = $this->createForm(CreatorType::class, $creator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->creatorService->save($creator);

            $this->addFlash(
                'success',
                $this->translator->trans('message.added_success')
            );

            return $this->redirectToRoute('creator_index');
        }

        return $this->render(
            'creator/create.html.twig',
            ['form' => $form->createView()]
        );
    }
}
