<?php

namespace App\Tests\Domain\Grupo;

use App\Domain\Grupo\GrupoId;
use DomainException;
use PHPUnit\Framework\TestCase;

class GrupoIdTest extends TestCase
{
    public function testShouldFailWhenInvalidUuid(): void
    {
        $this->expectException(DomainException::class);

        new GrupoId('aaaaaa');
    }

    public function testShouldRunWhenCreateValidUuid(): void
    {
        $uuid = "faf73380-7ab7-4c87-b8f1-03e8c6924ece";
        $grupo = new GrupoId($uuid);

        $this->assertEquals($uuid, $grupo->value());
        $this->assertEquals($uuid, (string) $grupo);
    }

    public function testShouldRunWhenGenerate(): void
    {
        $grupoId = GrupoId::generate();

        $this->assertNotEmpty($grupoId->value());
    }
}