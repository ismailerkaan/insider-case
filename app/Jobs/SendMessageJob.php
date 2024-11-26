<?php

namespace App\Jobs;

use App\Contracts\Repository\MessageRepositoryInterface;
use App\Contracts\Service\SendMessageServiceInterface;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $messageUuid;

    public function __construct(
        string $messageUuid
    ) {
        $this->messageUuid = $messageUuid;
    }

    /**
     * Execute the job.
     */
    public function handle(
        SendMessageServiceInterface $sendMessageService,
        MessageRepositoryInterface $messageRepository
    ): void
    {

        $message = $messageRepository->getMessage($this->messageUuid);

        if ($message->status != Message::STATUS_PENDING) {
            return;
        }

        $sendMessageService->handle($message);
    }
}
