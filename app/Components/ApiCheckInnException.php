<?php

namespace App\Components;

class ApiCheckInnException extends \Exception
{
    private $status;

    public function __construct(string $message, string $status)
    {
        parent::__construct($message, 0, null);

        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
