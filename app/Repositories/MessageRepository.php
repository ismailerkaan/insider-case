<?php

namespace App\Repositories;

use App\Contracts\Repository\MessageRepositoryInterface;
use App\DTO\MessageProviderResponse;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageRepositoryInterface
{
    public function getMessage(string $uuid): Message
    {
        return Message::find($uuid);
    }

    public function getPendingMessages(): Collection
    {
        return Message::pending()->get();
    }

    public function getSendedMessages(): Collection
    {
        return Message::sent()->get();
    }

    public function updateMessageAsSent(Message $message, MessageProviderResponse $response): bool
    {
        $message->status = Message::STATUS_FAILED;
        $message->sent_at = $response->getSentAt();

        if($response->getStatus()) {
            $message->status = Message::STATUS_SENT;
            $message->message_id = $response->getMessageId();
        }

        return $message->save();
    }

}
