<?php

namespace App\Tests\Domain\Recinto;

use App\Domain\Recinto\Recinto;
use PHPUnit\Framework\TestCase;

class RecintoTest extends TestCase
{
    public function testShouldRunWhenCreate(): void
    {
        $recinto = new Recinto('IFEMA', 100, 5);

        $this->assertEquals('IFEMA', $recinto->nombre());
        $this->assertEquals('IFEMA', (string) $recinto);
        $this->assertNotEmpty($recinto->id());
        $this->assertEquals(100, $recinto->costeAlquiler());
        $this->assertEquals(5, $recinto->precioEntrada());
    }
}