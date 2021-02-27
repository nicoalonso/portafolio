<?php

namespace App\Tests\Doubles\Infraestructure\Services;

use App\Domain\Services\MailNotify;

class MailNotifyStub implements MailNotify
{
    public function sendMail(string $address, string $body): void
    {

    }
}