<?php
namespace Server;

use Throwable;

class SwooleServerException extends \Exception{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}