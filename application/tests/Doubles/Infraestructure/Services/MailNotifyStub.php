<?php

namespace App\Tests\Doubles\Infraestructure\Services;

use App\Domain\Services\MailNotify;

class MailNotifyStub implements MailNotify
{
    public $countSendMail = 0;
    public string $mailAddress;
    public string $mailBody;

    public function sendMail(string $address, string $body): void
    {
        $this->countSendMail++;
        $this->mailAddress = $address;
        $this->mailBody = $body;
    }
}