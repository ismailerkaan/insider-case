<?php

namespace App\Http\Controllers\API\V1;


use App\Contracts\Repository\MessageRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Info(
 *    title="Your super  ApplicationAPI",
 *    version="1.0.0",
 * )
 */
class MessageController extends Controller
{

    public function __construct(
        private readonly MessageRepositoryInterface $messageRepository
    )
    {

    }

    /**
     * @OA\Get(
     *     path="/v1/messages/sent",
     *     tags={"Sent Messages"},
     *     summary="Lists Sent Messages",
     *     security={
     *         {"X-Api-Key": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Lists Sent Messages",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example="68e93bff-ab3b-11ef-95e7-0242ac1c0103"
     *                     ),
     *                     @OA\Property(
     *                         property="messageId",
     *                         type="string",
     *                         example="6c4a4334-9fd6-3791-a480-fcf7b8a38e36"
     *                     ),
     *                     @OA\Property(
     *                         property="status",
     *                         type="string",
     *                         example="sent"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function sendedMessageIndex(): ResourceCollection
    {
        $data = Cache::remember('message:sent', 3600, function (){
            return $this->messageRepository->getSendedMessages()->toArray();
        });

        return MessageResource::collection(
            $data
        );
    }
}
