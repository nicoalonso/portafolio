<?php declare(strict_types=1);

namespace App\Application\Concierto\Notify;

use App\Application\Concierto\Creator\ConciertoCreatedEvent;
use App\Domain\Concierto\Concierto;
use App\Domain\Services\MailNotify;

final class ConciertoPromotorMailDomainHandler
{
    private const PERDIDAS_MAIL_BODY = "El evento ha tenido unas perdidas de %d";
    private const GANANCIAS_MAIL_BODY = "El evento ha tenido unas ganancias de %d";

    public function __construct(MailNotify $notifier)
    {
        $this->notifier = $notifier;
    }

    public function __invoke(ConciertoCreatedEvent $conciertoCreateEvent)
    {
        $this->notify($conciertoCreateEvent->concierto());
    }

    private function notify(Concierto $concierto): void
    {
        $rentabilidad = $concierto->rentabilidad();
        $mensaje = ($rentabilidad < 0) ? self::PERDIDAS_MAIL_BODY: self::GANANCIAS_MAIL_BODY;
        $body = sprintf($mensaje, $rentabilidad);
        $address = $concierto->promotor()->email();
        $this->notifier->sendMail($address, $body);
    }
}