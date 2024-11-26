<?php

namespace App\Observers;

use App\Contracts\Service\SentMessageWebhookServiceInterface;
use App\Jobs\SendWebhookJob;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class MessageObserver
{
    const CACHE_KEY = 'message:sent';

    public function __construct(
        private readonly SentMessageWebhookServiceInterface $sentMessageWebhookService
    )
    {

    }

    /**
     * Handle the MessageResource "updated" event.
     */
    public function updated(Message $message): void
    {
        if ($message->status !== Message::STATUS_SENT) {
            return;
        }

        SendWebhookJob::dispatch($message);

        $messageList = Cache::get('message:sent', []);

        $messageList[] = [
            'id' => $message->id,
            'message_id' => $message->message_id,
            'status' => $message->status,
        ];

        Cache::put('message:sent', $messageList,3600);

    }

}
