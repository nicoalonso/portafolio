<?php

namespace App\Tests\Domain\MedioPublicitario;

use App\Domain\MedioPublicitario\MedioPublicitario;
use PHPUnit\Framework\TestCase;

class MedioPublicitarioTest extends TestCase
{
    public function testShouldRunWhenCreate(): void
    {
        $medio = new MedioPublicitario('tve');

        $this->assertEquals('tve', $medio->nombre());
        $this->assertEquals('tve', (string) $medio);
        $this->assertNotEmpty($medio->id());
    }
}