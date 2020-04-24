<?php


namespace App\Domain\Entity;


class Client
{
    private string $name;
    private string $email;
    private string $phone;
    private string $companyName;

    public function __construct(string $name, string $email, string $phone, string $companyName)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->companyName = $companyName;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function companyName(): string
    {
        return $this->companyName;
    }
}