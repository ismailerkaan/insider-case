<?php

namespace App\Contracts\Service;

use App\Models\Message;

interface SendMessageServiceInterface
{
    public function handle(Message $message): void;
}
