<?php

namespace App\Tests\Domain\Grupo;

use App\Domain\Grupo\Grupo;
use PHPUnit\Framework\TestCase;

class GrupoTest extends TestCase
{
    public function testShouldRunWhenCreate(): void
    {
        $grupo = new Grupo('ACDC', 10000, 'info@acdc.com');

        $this->assertEquals('ACDC', $grupo->nombre());
        $this->assertEquals(10000, $grupo->cache());
        $this->assertNotEmpty($grupo->id());
        $this->assertEquals('info@acdc.com', $grupo->email());
    }
}