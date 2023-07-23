<?php

namespace App\Dto;

class LoginDto extends BaseDto
{
    public ?string $email = null;
    public ?string $password = null;
}
