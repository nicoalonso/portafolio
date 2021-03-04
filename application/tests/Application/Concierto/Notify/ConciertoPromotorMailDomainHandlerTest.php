<?php declare(strict_types=1);

namespace App\Tests\Application\Concierto\Notify;

use App\Application\Concierto\Notify\ConciertoPromotorMailDomainHandler;
use App\Tests\Doubles\Infraestructure\Services\MailNotifyStub;
use PHPUnit\Framework\TestCase;

class ConciertoPromotorMailDomainHandlerTest extends TestCase
{
    public function setUp()
    {
        $this->notifierStub = new MailNotifyStub();
        $this->handler = new ConciertoPromotorMailDomainHandler($this->notifierStub);
    }

    /*public function testShouldNotifyWhenCreateConciertoWithGanancias(): void
    {
        $this->repoPromotorStub->promotorReturn = new Promotor('nico', 'nico@dummy.com');
        $this->repoRecintoStub->recintoReturn = new Recinto('IFEMA', 10000, 250);
        $this->repoGrupoStub->grupoById = [
            'aaaaaa-aaaaa-aaaaaa' => new Grupo('ACDC', 42000),
            'bbbbbb-bbbbb-bbbbbb' => new Grupo('The Beatles', 35000),
        ];
        $this->repoMedioStub->medioById = [
            'cccccc-ccccc-cccccc' => new MedioPublicitario('Interview'),
        ];

        $data = [
            'nombre' => 'Test',
            'fecha' => '25/06/2021',
            'numero_espectadores' => 10000,
            'promotor_id' => 'abcdef-dddd-abcdef',
            'recinto_id' => 'abcdef-dddd-abcdef',
            'grupos' => [
                'aaaaaa-aaaaa-aaaaaa',
                'bbbbbb-bbbbb-bbbbbb',
            ],
            'medios' => [
                'cccccc-ccccc-cccccc',
            ],
        ];
        $this->creator->dispatch($data);

        $this->assertEquals('nico@dummy.com', $this->notifierStub->mailAddress);
        $bodyExpected = 'El evento ha tenido unas ganancias de 1913000';
        $this->assertEquals($bodyExpected, $this->notifierStub->mailBody);
    }

    public function testShouldNotifyWhenCreateConciertoWithPerdidas(): void
    {
        $this->repoPromotorStub->promotorReturn = new Promotor('nico', 'nico@dummy.com');
        $this->repoRecintoStub->recintoReturn = new Recinto('IFEMA', 10000, 250);
        $this->repoGrupoStub->grupoById = [
            'aaaaaa-aaaaa-aaaaaa' => new Grupo('ACDC', 42000),
            'bbbbbb-bbbbb-bbbbbb' => new Grupo('The Beatles', 35000),
        ];
        $this->repoMedioStub->medioById = [
            'cccccc-ccccc-cccccc' => new MedioPublicitario('Interview'),
        ];

        $data = [
            'nombre' => 'Test',
            'fecha' => '25/06/2021',
            'numero_espectadores' => 10,
            'promotor_id' => 'abcdef-dddd-abcdef',
            'recinto_id' => 'abcdef-dddd-abcdef',
            'grupos' => [
                'aaaaaa-aaaaa-aaaaaa',
                'bbbbbb-bbbbb-bbbbbb',
            ],
            'medios' => [
                'cccccc-ccccc-cccccc',
            ],
        ];
        $this->creator->dispatch($data);

        $this->assertEquals('nico@dummy.com', $this->notifierStub->mailAddress);
        $bodyExpected = 'El evento ha tenido unas perdidas de -85000';
        $this->assertEquals($bodyExpected, $this->notifierStub->mailBody);
    }*/
}