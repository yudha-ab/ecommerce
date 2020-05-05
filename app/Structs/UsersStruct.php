<?php
namespace App\Structs;

/**
 * UsersStruct struct 
 * 
 * to define columns in table users
 */
class UsersStruct {
    public int $id;
    public string $email;
    public string $password;
    public ?string $name;
    public ?string $username;
    public bool $is_active;
    public string $source;
}