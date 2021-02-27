<?php declare(strict_types=1);

namespace App\Infrastructure\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

final class RequestJsonListener
{
    private const HEADER_APPLICATION_JSON   = 'application/json';
    private const JSON_DATA_ATTR = 'jsonData';

    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $request = $event->getRequest();
        if (
            !empty($request->getContent()) && 
            (self::HEADER_APPLICATION_JSON === $request->headers->get('content-type'))
        ) {
            $request->attributes->set(self::JSON_DATA_ATTR, json_decode($request->getContent(), true));
        }
    }
}