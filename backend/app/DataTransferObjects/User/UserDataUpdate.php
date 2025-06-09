<?php

namespace App\DataTransferObjects\User;

class UserDataUpdate
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(array $fields)
    {
        $this->name = $fields['name'];
        $this->email = $fields['email'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}