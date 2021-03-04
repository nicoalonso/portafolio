<?php declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Services\MailNotify as MailNotifyInterface;

final class MailNotify implements MailNotifyInterface
{
    public function sendMail(string $address, string $body): void
    {
        
    }
}