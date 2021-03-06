<?php

namespace App\Tests\Domain\Concierto;

use App\Domain\Concierto\Concierto;
use App\Domain\Grupo\Grupo;
use App\Domain\Promotor\Promotor;
use App\Domain\Recinto\Recinto;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ConciertoTest extends TestCase
{
    private Promotor $promotor;
    private Recinto $recinto;
    private Concierto $concierto;

    public function setUp(): void
    {
        $this->promotor = new Promotor('nico', 'nico@dummy.com');
        $this->recinto = new Recinto('Ifema', 5000, 5);

        $this->concierto = new Concierto(
            'Test',
            $this->promotor,
            $this->recinto,
            50000,
            new DateTimeImmutable()
        );
    }

    public function testShouldRunWhenCreate(): void
    {
        $this->assertEquals('Test', (string) $this->concierto);
        $this->assertEquals('Test', $this->concierto->nombre());
        $this->assertNotEmpty($this->concierto->id());
        $this->assertEquals($this->promotor, $this->concierto->promotor());
        $this->assertEquals($this->recinto, $this->concierto->recinto());
        $this->assertEquals(50000, $this->concierto->numeroEspectadores());
        $this->assertEquals(250000, $this->concierto->calcBeneficios());
        $this->assertEquals(5000, $this->concierto->calcGastos());
        $this->assertEquals(245000, $this->concierto->rentabilidad());
    }

    public function testShouldGananciasWhenCacheGruposEsMenor(): void
    {
        $grupo1 = new Grupo('ACDC', 500);
        $grupo2 = new Grupo('Beatles', 1000);
        $grupo3 = new Grupo('Rollings', 2000);
        $this->concierto->addGrupo($grupo1);
        $this->concierto->addGrupo($grupo2);
        $this->concierto->addGrupo($grupo3);

        $this->assertEquals(250000, $this->concierto->calcBeneficios());
        $this->assertEquals(83500, $this->concierto->calcGastos());
        $this->assertEquals(166500, $this->concierto->rentabilidad());
    }

    public function testShouldPerdidasWhenCacheGruposEsMenor(): void
    {
        $grupo1 = new Grupo('ACDC', 500000);
        $grupo2 = new Grupo('Beatles', 10000);
        $grupo3 = new Grupo('Rollings', 20000);
        $this->concierto->addGrupo($grupo1);
        $this->concierto->addGrupo($grupo2);
        $this->concierto->addGrupo($grupo3);

        $this->assertEquals(250000, $this->concierto->calcBeneficios());
        $this->assertEquals(610000, $this->concierto->calcGastos());
        $this->assertEquals(-360000, $this->concierto->rentabilidad());
    }
}