<?php

namespace App\Services;

use App\Models\Message;
use App\Contracts\Service\SentMessageWebhookServiceInterface;
use Illuminate\Support\Facades\Http;

class SentMessageWebhookService implements SentMessageWebhookServiceInterface
{
    public function handle(Message $message): void
    {
        Http::post('https://webhook.site/a8d2d88b-5fcd-4c09-86df-b97972e5dea5', [
            'to' => $message->recipient,
            'content' => $message->content,
        ]);
    }

}
