<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\AppService;
use App\Service\UserService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class wich contains functions to return a Response most of time render a Twig template
 * Each fonctions are assigned with a route
 */
class UserController extends AbstractController
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
     * Route to display all the users registered in Session
     * Form available to add a new User into Session
     */
    public function list(Request $request, UserService $userService, AppService $appService): Response
    {
        try {
            // Create the form for a new User
            $form = $this->createForm(UserType::class, new User());
            $form->handleRequest($request);
            $errors = [];

            // When submitting the form
            if ($form->isSubmitted()) {
                // Retrieves errors validations
                $errors = $appService->getFormErrors($form);

                // The form is valid and no errors
                if (count($errors) === 0) {
                    // Save the new User in session
                    $userService->saveUser($form->getData());
                    $this->addFlash("success", $this->translator->trans("controller.user.list.flashNewAdded", [], 'messages', 'en'));

                    // Redirect to the same route
                    return $this->redirectToRoute('user_list', [], Response::HTTP_SEE_OTHER);
                }
            }

            // Display the twig template
            // Injecting to the template the list of users
            // The form to add a new User
            // And errors validations if any
            return $this->render('user/list.html.twig', [
                "users" => $userService->getAll(),
                "form" => $form->createView(),
                "errors" => $errors
            ]);
        } catch (\Throwable $e) {
            // If any exception occurs
            // Log the exception
            // Then redirect to error 500 page
            $this->logger->error($e->getMessage(), $e->getTrace());
            $this->addFlash('danger', 'Internal Error');
            return $this->render('bundles/TwigBundle/Exception/error500.html.twig', ["error" => $e->getMessage()]);
        }
    }
}
