<?php

namespace App\Contracts\Service;

use App\Models\Message;

interface SentMessageWebhookServiceInterface
{
    public function handle(Message $message): void;
}
