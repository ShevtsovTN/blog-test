<?php

namespace App\Dto;

class BaseDto
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public static function fromRequest(array $data): static
    {
        return new static($data);
    }
}
