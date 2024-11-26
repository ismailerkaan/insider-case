<?php

namespace App\Exceptions;

class NotValidStatusForMessageSend extends \Exception
{
    protected $message = 'Not valid status for message send';
    protected $code = 400;

    public function __construct($message = null, $code = null)
    {
        if ($message) {
            $this->message = $message;
        }

        if ($code) {
            $this->code = $code;
        }
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
            'code' => $this->code
        ], $this->code);
    }
}
