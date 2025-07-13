<?php

namespace App\Message\Command\User;

use App\DTO\Registration\OutputDto;

class RegisteredMessage
{
    private OutputDto $user;

    public function __construct(OutputDto $user)
    {
        $this->user = $user;
    }

    public function getUser(): OutputDto
    {
        return $this->user;
    }
}
