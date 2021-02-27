<?php declare(strict_types=1);

namespace App\Domain\Services;

interface MailNotify
{
    public function sendMail(string $address, string $body): void;
}