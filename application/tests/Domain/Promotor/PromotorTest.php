<?php

namespace App\Tests\Domain\Promotor;

use App\Domain\Promotor\Promotor;
use PHPUnit\Framework\TestCase;

class PromotorTest extends TestCase
{
    public function testShouldRunWhenCreate(): void
    {
        $promotor = new Promotor('Pepito', 'pepito@mail.com');

        $this->assertEquals('Pepito', $promotor->nombre());
        $this->assertEquals('Pepito', (string) $promotor);
        $this->assertNotEmpty($promotor->id());
        $this->assertEquals('pepito@mail.com', $promotor->email());
    }
}