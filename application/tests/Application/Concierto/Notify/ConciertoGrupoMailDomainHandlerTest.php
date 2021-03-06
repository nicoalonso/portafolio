<?php

namespace App\Tests\Application\Concierto\Notify;

use App\Application\Concierto\Creator\ConciertoCreatedEvent;
use App\Application\Concierto\Notify\ConciertoGrupoMailDomainHandler;
use App\Domain\Concierto\Concierto;
use App\Domain\Grupo\Grupo;
use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\Promotor\Promotor;
use App\Domain\Recinto\Recinto;
use App\Tests\Doubles\Infraestructure\Services\MailNotifyStub;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ConciertoGrupoMailDomainHandlerTest extends TestCase
{
    private MailNotifyStub $notifierStub;
    private ConciertoGrupoMailDomainHandler $handler;

    public function setUp(): void
    {
        $this->notifierStub = new MailNotifyStub();
        $this->handler = new ConciertoGrupoMailDomainHandler($this->notifierStub);
    }

    public function testShouldNotifyWhenCreateConcierto(): void
    {
        $promotor = new Promotor('nico', 'nico@dummy.com');
        $recinto = new Recinto('IFEMA', 10000, 250);
        $grupos = [
            new Grupo('ACDC', 42000, 'info@acdc.com'),
            new Grupo('The Beatles', 35000, 'info@thebeatles.com'),
            new Grupo('Other', 35000),
        ];
        $medios = [
            new MedioPublicitario('Interview'),
        ];
        $fecha = new DateTimeImmutable();
        $concierto = new Concierto(
            'Test', $promotor, $recinto,
            10000, $fecha,
            $grupos, $medios
        );
        $event = new ConciertoCreatedEvent($concierto);

        $this->handler->__invoke($event);

        $this->assertEquals(2, $this->notifierStub->countSendMail);
        $this->assertEquals('info@thebeatles.com', $this->notifierStub->mailAddress);
        $fecha = $fecha->format(DATE_ATOM);
        $bodyExpected = "Concierto Test que se va ha desarrollar en el recinto IFEMA en la fecha $fecha";
        $this->assertEquals($bodyExpected, $this->notifierStub->mailBody);
    }
}