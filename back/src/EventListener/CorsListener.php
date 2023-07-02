<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class CorsListener implements EventSubscriberInterface
{
    private $accessControlAllowCredentials;
    private $accessControlAllowOrigin;
    private $accessControlAllowMethods;
    private $accessControlAllowHeaders;
    private $accessControlMaxAge;

    public function __construct(
        string $accessControlAllowCredentials,
        string $accessControlAllowOrigin,
        string $accessControlAllowMethods,
        string $accessControlAllowHeaders,
        int $accessControlMaxAge//,

        // ParameterBagInterface $parameterBag // OR
    ) {
        // $this->accessControlAllowCredentials = $parameterBag->get("accessControlAllowCredentials");
        $this->accessControlAllowCredentials = $accessControlAllowCredentials;
        $this->accessControlAllowOrigin = $accessControlAllowOrigin;
        $this->accessControlAllowMethods = $accessControlAllowMethods;
        $this->accessControlAllowHeaders = $accessControlAllowHeaders;
        $this->accessControlAllowHeaders = $accessControlAllowHeaders;
        $this->accessControlMaxAge = $accessControlMaxAge;
    }

    private function modifyResponse(?Response &$response): void
    {
        if ($response) {
            $response->headers->set('Access-Control-Allow-Credentials', $this->accessControlAllowCredentials);
            $response->headers->set('Access-Control-Allow-Origin', $this->accessControlAllowOrigin);
            $response->headers->set('Access-Control-Allow-Methods', $this->accessControlAllowMethods);
            $response->headers->set('Access-Control-Allow-Headers', $this->accessControlAllowHeaders);
            $response->headers->set('Access-Control-Max-Age', $this->accessControlMaxAge);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 9999],
            KernelEvents::RESPONSE => ['onKernelResponse', 9999],
            KernelEvents::EXCEPTION => ['onKernelException', 9999],
        ];
    }

    public function onKernelRequest(?RequestEvent $event): void
    {
        // Don't do anything if it's not the master request.
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $method = $request->getRealMethod();

        if (Request::METHOD_OPTIONS === $method) {
            $response = new Response();
            $event->setResponse($response);
        }
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        // Don't do anything if it's not the master request.
        if (!$event->isMasterRequest()) {
            return;
        }

        $response = $event->getResponse();
        $this->modifyResponse($response);
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $response = $event->getResponse();
        $this->modifyResponse($response);
    }
}
