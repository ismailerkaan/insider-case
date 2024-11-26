<?php

namespace Tests\Unit\Services;

use App\Contracts\Repository\MessageRepositoryInterface;
use App\Exceptions\NotValidStatusForMessageSend;
use App\Models\Message;
use App\Services\SendMessageService;
use Faker\Generator;
use Mockery;
use Tests\TestCase;

class SendMessageServiceTest extends TestCase
{
    public function test_handle_sends_message_successfully()
    {
        $faker = Mockery::mock(Generator::class);
        $faker->shouldReceive('uuid')->andReturn('fake-uuid');
        $faker->shouldReceive('format')->andReturn('fake-uuid');

        $messageRepository = Mockery::mock(MessageRepositoryInterface::class);
        $messageRepository->shouldReceive('updateMessageAsSent')->once();

        $service = new SendMessageService($faker, $messageRepository);

        $message = new Message();
        $message->id = 1;
        $message->status = Message::STATUS_PENDING;

        $service->handle($message);

        $this->assertTrue(true);
    }

    public function test_handle_throws_exception_for_invalid_status()
    {
        $faker = Mockery::mock(Generator::class);
        $messageRepository = Mockery::mock(MessageRepositoryInterface::class);

        $service = new SendMessageService($faker, $messageRepository);

        $message = new Message();
        $message->id = 1;
        $message->status = 'invalid-status';

        $this->expectException(NotValidStatusForMessageSend::class);
        $this->expectExceptionMessage('Only pending messages can be sent.');

        $service->handle($message);
    }
}
