<?php declare(strict_types=1);

namespace App\Tests\Application\Concierto\Notify;

use App\Application\Concierto\Creator\ConciertoCreatedEvent;
use App\Application\Concierto\Notify\ConciertoPromotorMailDomainHandler;
use App\Domain\Concierto\Concierto;
use App\Domain\Grupo\Grupo;
use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\Promotor\Promotor;
use App\Domain\Recinto\Recinto;
use App\Tests\Doubles\Infraestructure\Services\MailNotifyStub;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ConciertoPromotorMailDomainHandlerTest extends TestCase
{
    private MailNotifyStub $notifierStub;
    private ConciertoPromotorMailDomainHandler $handler;

    public function setUp(): void
    {
        $this->notifierStub = new MailNotifyStub();
        $this->handler = new ConciertoPromotorMailDomainHandler($this->notifierStub);
    }

    public function testShouldNotifyWhenCreateConciertoWithGanancias(): void
    {
        $promotor = new Promotor('nico', 'nico@dummy.com');
        $recinto = new Recinto('IFEMA', 10000, 250);
        $grupos = [
            new Grupo('ACDC', 42000),
            new Grupo('The Beatles', 35000),
        ];
        $medios = [
            new MedioPublicitario('Interview'),
        ];
        $concierto = new Concierto(
            'Test', $promotor, $recinto,
            10000, new DateTimeImmutable(),
            $grupos, $medios
        );
        $event = new ConciertoCreatedEvent($concierto);

        $this->handler->__invoke($event);

        $this->assertEquals('nico@dummy.com', $this->notifierStub->mailAddress);
        $bodyExpected = 'El evento ha tenido unas ganancias de 1913000';
        $this->assertEquals($bodyExpected, $this->notifierStub->mailBody);
    }

    public function testShouldNotifyWhenCreateConciertoWithPerdidas(): void
    {
        $promotor = new Promotor('nico', 'nico@dummy.com');
        $recinto = new Recinto('IFEMA', 10000, 250);
        $grupos = [
            new Grupo('ACDC', 42000),
            new Grupo('The Beatles', 35000),
        ];
        $medios = [
            new MedioPublicitario('Interview'),
        ];
        $concierto = new Concierto(
            'Test', $promotor, $recinto,
            10, new DateTimeImmutable(),
            $grupos, $medios
        );
        $event = new ConciertoCreatedEvent($concierto);

        $this->handler->__invoke($event);

        $this->assertEquals('nico@dummy.com', $this->notifierStub->mailAddress);
        $bodyExpected = 'El evento ha tenido unas perdidas de -85000';
        $this->assertEquals($bodyExpected, $this->notifierStub->mailBody);
    }
}