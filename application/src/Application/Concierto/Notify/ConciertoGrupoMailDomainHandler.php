<?php declare(strict_types=1);

namespace App\Application\Concierto\Notify;

use App\Application\Concierto\Creator\ConciertoCreatedEvent;
use App\Domain\Concierto\Concierto;
use App\Domain\Services\MailNotify;

final class ConciertoGrupoMailDomainHandler
{
    private const GRUPO_INFO_MAIL_BODY = "Concierto %nombre% que se va ha desarrollar en el recinto %recinto% en la fecha %fecha%";
    private const NOMBRE_MAIL_PARAM = '%nombre%';
    private const RECINTO_MAIL_PARAM = '%recinto%';
    private const FECHA_MAIL_PARAM = '%fecha%';

    private Concierto $concierto;

    public function __construct(MailNotify $notifier)
    {
        $this->notifier = $notifier;
    }

    public function __invoke(ConciertoCreatedEvent $conciertoCreatedEvent)
    {
        $this->concierto = $conciertoCreatedEvent->concierto();
        $this->notify();
    }

    private function notify(): void
    {
        $mailBody = $this->makeMailBody();

        foreach ($this->concierto->grupos() as $grupo) {
            if (empty($grupo->email())) {
                continue;
            }

            $this->notifier->sendMail($grupo->email(), $mailBody);
        }
    }

    private function makeMailBody(): string
    {
        $search = [self::NOMBRE_MAIL_PARAM, self::RECINTO_MAIL_PARAM, self::FECHA_MAIL_PARAM];
        $replace = [
            $this->concierto->nombre(),
            $this->concierto->recinto()->nombre(),
            $this->concierto->fechaWithFormat(),
        ];
        return str_replace($search, $replace, self::GRUPO_INFO_MAIL_BODY);
    }
}