<?php

namespace App\DataTransferObjects\User;

class UserData
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(array $fields)
    {
        $this->name = $fields['name'];
        $this->email = $fields['email'];
        $this->password = $fields['password'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}