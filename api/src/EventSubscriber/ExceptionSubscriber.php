<?php

namespace App\EventSubscriber;

use Exception;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onException(ExceptionEvent $event): void
    {
        // $event->getRequest()->setRequestFormat('json');
        // dd($event->getRequest()->getPathInfo());
        // dd($event->getThrowable());

        if (
            $event->getRequest()->getPathInfo() == "/api/teams" ||
            $event->getRequest()->getPathInfo() == "/api/team-members"
        ) {
            $event->allowCustomResponseCode();

            $response = new JsonResponse(
                [
                    "errors" => "The received file cannot be processed. Please check its contents."
                ],
                400
            );

            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => 'onException'
        ];
    }
}
