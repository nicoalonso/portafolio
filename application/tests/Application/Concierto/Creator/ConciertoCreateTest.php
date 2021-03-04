<?php

namespace App\Tests\Application\Concierto\Creator;

use App\Application\Concierto\Creator\ConciertoCreate;
use App\Application\Concierto\Creator\ConciertoCreateException;
use App\Domain\Exception\DateFormatException;
use App\Domain\Exception\FieldRequiredException;
use App\Domain\Grupo\Grupo;
use App\Domain\Grupo\GrupoNotFoundException;
use App\Domain\MedioPublicitario\MedioNotFoundException;
use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\Promotor\Promotor;
use App\Domain\Promotor\PromotorNotFoundException;
use App\Domain\Recinto\Recinto;
use App\Domain\Recinto\RecintoNotFoundException;
use App\Tests\Doubles\Infraestructure\Bus\SymfonyDomainBusStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\ConciertoRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\GrupoRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\MedioPublicitarioRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\PromotorRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\RecintoRepositoryStub;
use PHPUnit\Framework\TestCase;

class ConciertoCreateTest extends TestCase
{
    private ConciertoRepositoryStub $repoConciertoStub;
    private RecintoRepositoryStub $repoRecintoStub;
    private GrupoRepositoryStub $repoGrupoStub;
    private PromotorRepositoryStub $repoPromotorStub;
    private MedioPublicitarioRepositoryStub $repoMedioStub;
    private SymfonyDomainBusStub $domainBusStub;

    public function setUp(): void
    {
        $this->repoConciertoStub = new ConciertoRepositoryStub();
        $this->repoRecintoStub = new RecintoRepositoryStub();
        $this->repoGrupoStub = new GrupoRepositoryStub();
        $this->repoPromotorStub = new PromotorRepositoryStub();
        $this->repoMedioStub = new MedioPublicitarioRepositoryStub();
        $this->domainBusStub = new SymfonyDomainBusStub();

        $this->creator = new ConciertoCreate(
            $this->repoConciertoStub,
            $this->repoRecintoStub,
            $this->repoGrupoStub,
            $this->repoPromotorStub,
            $this->repoMedioStub,
            $this->domainBusStub
        );
    }

    public function testShouldFailWhenEmptyData(): void
    {
        $this->expectException(FieldRequiredException::class);
        $this->expectExceptionMessage('nombre es obligatorio');

        $data = [];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenFechaIsRequired(): void
    {
        $this->expectException(FieldRequiredException::class);
        $this->expectExceptionMessage('promotor_id es obligatorio');

        $data = [
            'nombre' => 'Test',
            'fecha' => '----',
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenPromotorIsRequired(): void
    {
        $this->expectException(FieldRequiredException::class);
        $this->expectExceptionMessage('promotor_id es obligatorio');

        $data = [
            'nombre' => 'Test',
            'fecha' => '----',
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenRecintoIsRequired(): void
    {
        $this->expectException(FieldRequiredException::class);
        $this->expectExceptionMessage('recinto_id es obligatorio');

        $data = [
            'nombre' => 'Test',
            'fecha' => '----',
            'promotor_id' => 'aaaaaa-aaaaa-aaaaaa',
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenWrongNoDate(): void
    {
        $this->expectException(FieldRequiredException::class);
        $this->expectExceptionMessage('fecha es obligatorio');

        $data = [
            'nombre' => 'Test',
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenWrongDate(): void
    {
        $this->expectException(DateFormatException::class);

        $data = [
            'nombre' => 'Test',
            'fecha' => '----',
            'promotor_id' => '',
            'recinto_id' => '',
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenPromotorNotFound(): void
    {
        $this->expectException(PromotorNotFoundException::class);

        $data = [
            'nombre' => 'Test',
            'fecha' => '25/06/2021',
            'numero_espectadores' => 10000,
            'promotor_id' => 'abcdef-dddd-abcdef',
            'recinto_id' => 'abcdef-dddd-abcdef',
            'grupos' => [],
            'medios' => [],
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenRecintoNotFound(): void
    {
        $this->expectException(RecintoNotFoundException::class);

        $this->repoPromotorStub->promotorReturn = new Promotor('nico', 'nico@dummy.com');
        $data = [
            'nombre' => 'Test',
            'fecha' => '25/06/2021',
            'numero_espectadores' => 10000,
            'promotor_id' => 'abcdef-dddd-abcdef',
            'recinto_id' => 'abcdef-dddd-abcdef',
            'grupos' => [],
            'medios' => [],
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldfailWhenGrupoNotFound(): void
    {
        $this->expectException(GrupoNotFoundException::class);

        $this->repoPromotorStub->promotorReturn = new Promotor('nico', 'nico@dummy.com');
        $this->repoRecintoStub->recintoReturn = new Recinto('IFEMA', 10000, 250);

        $data = [
            'nombre' => 'Test',
            'fecha' => '25/06/2021',
            'numero_espectadores' => 10000,
            'promotor_id' => 'abcdef-dddd-abcdef',
            'recinto_id' => 'abcdef-dddd-abcdef',
            'grupos' => [
                'aaaaaa-aaaaa-aaaaaa',
            ],
            'medios' => [],
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenMedioNotFound(): void
    {
        $this->expectException(MedioNotFoundException::class);

        $this->repoPromotorStub->promotorReturn = new Promotor('nico', 'nico@dummy.com');
        $this->repoRecintoStub->recintoReturn = new Recinto('IFEMA', 10000, 250);
        $this->repoGrupoStub->grupoById = [
            'aaaaaa-aaaaa-aaaaaa' => new Grupo('ACDC', 42000),
            'bbbbbb-bbbbb-bbbbbb' => new Grupo('The Beatles', 35000),
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
    }

    public function testShouldSaveConciertoWhenDataIsOK(): void
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

        $this->assertNotNull($this->repoConciertoStub->conciertoSaved);
        $this->assertNotNull($this->domainBusStub->domainEvent);
    }
}