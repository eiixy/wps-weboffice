<?php


namespace Eiixy\WebOffice\Exceptions;


use Throwable;

class WebOfficeException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json([
            'code' => $this->code,
            'msg' => $this->message
        ],400);
    }
}
