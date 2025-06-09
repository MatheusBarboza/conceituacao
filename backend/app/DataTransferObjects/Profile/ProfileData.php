<?php

namespace App\DataTransferObjects\Profile;

class ProfileData
{
    public string $name;

    public function __construct(array $fields)
    {
        $this->name = $fields['name'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}