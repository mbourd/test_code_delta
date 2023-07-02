<?php

namespace App\Controller;

use App\Form\UserType;
use App\Service\AppService;
use App\Service\UserService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

/**
 * Class wich contains functions to return a JsonResponse
 * Each functions are assigned with an API  route
 * Mainly used for API requests
 * Each functions are accessible with the HTTP methods defined
 *
 * @Route("/api/users")
 */
class ApiUserController extends AbstractController
{
    /** @var LoggerInterface */
    private $logger;

    /** @var Serializer */
    private $serializer;

    public function __construct(AppService $appService, LoggerInterface $logger)
    {
        $this->serializer = $appService->getSerializer();
        $this->logger = $logger;
    }

    /**
     * @return Response
     * @Route("/all", name="get_users", methods={"GET"})
     */
    public function getUsers(UserService $userService): Response
    {
        try {
            $response = new Response(
                $this->serializer->serialize($userService->getAll(), 'json'),
                Response::HTTP_OK,
                [
                    'Content-type' => 'application/json',
                ]
            );

            return $response;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
            $response = new Response(
                $this->serializer->serialize($e->getMessage(), 'json'),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                [
                    'Content-type' => 'application/json',
                ]
            );

            return $response;
        }
    }

    /**
     * @return Response
     * @Route("/add", name="post_users", methods={"POST"})
     */
    public function addUser(Request $req, UserService $userService, AppService $appService): Response
    {
        try {
            // Retrieve data
            $data = json_decode($req->getContent() /*req.body*/, true);

            $form = $this->createForm(UserType::class, null, ['method' => 'POST', 'csrf_protection' => false]);
            $form->submit($data, true);

            if (!$form->isValid()) {
                $errors = $appService->getFormErrors($form);

                return new Response(
                    $this->serializer->serialize($errors, 'json'),
                    Response::HTTP_BAD_REQUEST,
                    [
                        'Content-type' => 'application/json',
                    ]
                );
            }

            $user = $userService->saveUser($form->getData());

            $response = new Response(
                $this->serializer->serialize($user, 'json'),
                Response::HTTP_OK,
                [
                    'Content-type' => 'application/json',
                ]
            );

            return $response;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
            $response = new Response(
                $this->serializer->serialize($e->getMessage(), 'json'),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                [
                    'Content-type' => 'application/json',
                ]
            );

            return $response;
        }
    }
}
