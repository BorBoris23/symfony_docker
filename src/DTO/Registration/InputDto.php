<?php

namespace App\DTO\Registration;

use App\Validator\PhoneNumber;
use App\Validator\UniqueEmail;
use App\Validator\UniquePhone;
use Symfony\Component\Validator\Constraints as Assert;

class InputDto
{
    #[Assert\NotBlank(message: "Name is required.")]
    #[Assert\Length(max: 255)]
    public string $name;

    #[Assert\NotBlank(message: "Email is required.")]
    #[Assert\Email(message: "Invalid email address.")]
    #[Assert\Length(max: 180)]
    #[UniqueEmail]
    public string $email;

    #[Assert\NotBlank(message: "Phone number is required.")]
    #[Assert\Regex(
        pattern: '/^\+?[0-9]{10,15}$/',
        message: "Invalid phone number format."
    )]
    #[PhoneNumber(region: 'RU')]
    #[UniquePhone]
    public string $phone;

    #[Assert\NotBlank(message: "Password is required.")]
    #[Assert\Length(min: 6, max: 64)]
    public string $password;
}
