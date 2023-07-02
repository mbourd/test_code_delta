<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class wich contains functions to return a Response most of time render a Twig template
 * Each fonctions are assigned with a route
 */
class HomeController extends AbstractController
{
    /** @var LoggerInterface */
    private $logger;

    /** @var TranslatorInterface */
    private $translator;

    public function __construct(LoggerInterface $logger, TranslatorInterface $translator)
    {
        $this->logger = $logger;
        $this->translator = $translator;
    }

    /**
     * Route to display the welcome page
     */
    public function index(): Response
    {
        try {
            return $this->render('home/home.html.twig', []);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
            $this->addFlash('danger', 'Server Error');
            return $this->render('bundles/TwigBundle/Exception/error500.html.twig', ["error" => $e->getMessage()]);
        }
    }
}
