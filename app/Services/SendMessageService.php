<?php

namespace App\Services;

use App\Contracts\Repository\MessageRepositoryInterface;
use App\Contracts\Service\SendMessageServiceInterface;
use App\DTO\MessageProviderResponse;
use App\Exceptions\NotValidStatusForMessageSend;
use App\Models\Message;
use Faker\Generator;

class SendMessageService implements SendMessageServiceInterface
{
    public function __construct(
        private readonly Generator $faker,
        private readonly MessageRepositoryInterface $messageRepository,
    )
    {

    }

    public function handle(Message $message): void
    {
        if ($message->status != Message::STATUS_PENDING) {
            throw new NotValidStatusForMessageSend('Only pending messages can be sent.', 400);
        }

        $messageProviderResponse = $this->send($message);
        $this->messageRepository->updateMessageAsSent($message, $messageProviderResponse);
    }

    private function send(Message $message) : MessageProviderResponse
    {
        $providerResponse = new MessageProviderResponse();

        $providerResponse->setUuid($message->id);

        $providerResponse->setMessageId(
            $this->generateFakeMessageResponseId()
        );

        $providerResponse->setStatus(true);

        $providerResponse->setSentAt(now());

        return $providerResponse;
    }

    private function generateFakeMessageResponseId(): string
    {
        return $this->faker->uuid;
    }

}
