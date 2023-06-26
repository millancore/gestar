<?php

namespace Xfrmk\DB\Exception;

use Exception;

class ConnectionException extends Exception
{
    public function __construct(
        null|string $message,
        int $code,
    )
    {
        parent::__construct($message ?? '', $code);
    }

}