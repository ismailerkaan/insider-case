<?php

namespace App\Console\Commands;

use App\Contracts\Repository\MessageRepositoryInterface;
use App\Jobs\SendMessageJob;
use Illuminate\Console\Command;

class ProcessMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-messages-to-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pending messages to the queue.';

    public function __construct(
        private readonly MessageRepositoryInterface $messageRepository
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = $this->messageRepository->getPendingMessages();

        foreach ($messages as $message) {
            SendMessageJob::dispatch($message->id);
        }
    }
}
