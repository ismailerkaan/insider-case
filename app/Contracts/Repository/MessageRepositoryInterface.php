<?php

namespace App\Contracts\Repository;

use App\DTO\MessageProviderResponse;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
    /**
     * @param string $uuid
     * @return Message
     */
    public function getMessage(string $uuid): Message;

    /**
     * @return Collection
     */
    public function getPendingMessages(): Collection;

    /**
     * @return Collection
     */
    public function getSendedMessages(): Collection;

    /**
     * @param Message $message
     * @param MessageProviderResponse $response
     * @return bool
     */
    public function updateMessageAsSent(Message $message, MessageProviderResponse $response): bool;

}
