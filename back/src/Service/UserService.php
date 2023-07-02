<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class User Service
 * to provide methods to save and get all Users
 */
class UserService
{
    /** @var SessionInterface */
    private $session;

    /** @var Serializer */
    private $serializer;

    // /** @var EntityManagerInterface */
    // private $manager;

    // /** @var UserRepository */
    // private $repo;

    /**
     * Inject all necessary Services
     * And check if the session contains "users" key
     */
    public function __construct(
        // EntityManagerInterface $manager,
        // UserRepository $userRepository,
        SessionInterface $session,
        AppService $appService
    )
    {
        // $this->manager = $manager;
        // $this->repo = $userRepository;

        // Serializer to serialize entities
        $this->serializer = $appService->getSerializer();
        // The session
        $this->session = $session;

        // Initialize default value if the session doesn't contain "users" key
        if (!$this->session->has("users")) {
            $this->session->set('users', $this->serializer->serialize([], 'json'));
        }
    }

    /**
     * Method to save the new User in session
     */
    public function saveUser(User $user): User
    {
        // First retrieve all users from the session
        $users = $this->getAll();
        // Push the new User
        array_push($users, $user);

        // Then replace the "users" key with the new list of User
        $this->session->set("users", $this->serializer->serialize($users, 'json'));

        // return the created User
        return $user;
    }

    /**
     * Retrieve all Users from the session and parse into an Array User[]
     */
    public function getAll(): array
    {
        return $this->serializer->deserialize($this->session->get('users'), 'App\Entity\User[]', "json");
    }
}
