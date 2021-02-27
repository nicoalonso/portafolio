<?php

namespace App\Tests\Application\Concierto\Creator;

use App\Application\Concierto\Creator\ConciertoCreate;
use App\Application\Concierto\Creator\ConciertoCreateException;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\ConciertoRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\GrupoRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\MedioPublicitarioRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\PromotorRepositoryStub;
use App\Tests\Doubles\Infraestructure\Persistence\Doctrine\Repository\RecintoRepositoryStub;
use App\Tests\Doubles\Infraestructure\Services\MailNotifyStub;
use PHPUnit\Framework\TestCase;

class ConciertoCreateTest extends TestCase
{
    private ConciertoRepositoryStub $repoConciertoStub;
    private RecintoRepositoryStub $repoRecintoStub;
    private GrupoRepositoryStub $repoGrupoStub;
    private PromotorRepositoryStub $repoPromotorStub;
    private MedioPublicitarioRepositoryStub $repoMedioStub;
    private MailNotifyStub $notifierStub;

    public function setUp(): void
    {
        $this->repoConciertoStub = new ConciertoRepositoryStub();
        $this->repoRecintoStub = new RecintoRepositoryStub();
        $this->repoGrupoStub = new GrupoRepositoryStub();
        $this->repoPromotorStub = new PromotorRepositoryStub();
        $this->repoMedioStub = new MedioPublicitarioRepositoryStub();
        $this->notifierStub = new MailNotifyStub();

        $this->creator = new ConciertoCreate(
            $this->repoConciertoStub,
            $this->repoRecintoStub,
            $this->repoGrupoStub,
            $this->repoPromotorStub,
            $this->repoMedioStub,
            $this->notifierStub
        );
    }

    public function testShouldFailWhenWrongDate(): void
    {
        $this->expectException(ConciertoCreateException::class);
        $this->expectExceptionMessage('Formato de fecha incorrecto');

        $data = [
            'nombre' => 'Test',
            'fecha' => '----',
        ];
        $this->creator->dispatch($data);
    }

    public function testShouldFailWhenPromotorNotFound(): void
    {
        
    }
}